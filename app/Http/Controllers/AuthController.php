<?php

namespace App\Http\Controllers;

use App\Helper\CartCount;
use App\Helper\Messages;
use App\Helper\ResendSession;
use App\Helper\SMS;
use App\Http\Requests\Front\Auth\CheckCodeRequest;
use App\Http\Requests\Front\Auth\LoginRequest;
use App\Http\Requests\Front\Auth\RegisterRequest;
use App\Http\Requests\Front\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function loginView()
    {
        if (\auth()->check()) {
            return back();
        }
        return view('front.auth.login');
    }

    public function registerView()
    {
        if (\auth()->check()) {
            return back();
        }
        return view('front.auth.register');
    }

    public function forgetPasswordView()
    {
        if (\auth()->check()) {
            return back();
        }
        return view('front.auth.forgetPassword');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['mobile' => $request->validated()['mobile'], 'password' => $request->validated()['password']], $request->remember)) {
            CartCount::addCookieToCart();
            if (\auth()->user()->verified == 0) {
                $url = route('mobile-confirm');
                SMS::send(\auth()->user()->mobile, Messages::Code . \auth()->user()->verifiy_code);
            } else {
                $url = route('home');
            }
            return response(['status' => 200, 'url' => $url], 200);
        } else {
            return response(['status' => 400, 'message' => trans('api.login_error')], 200);
        }
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userRepo->register($request->validated());
        SMS::send($user->mobile, Messages::Code . $user->verifiy_code);
        //TODO Send SMS TO User
        Auth::login($user);
        CartCount::addCookieToCart();
        return response(['status' => 200, 'message' => trans('admin.register_message'), 'url' => route('mobile-confirm')], 200);
    }

    public function confirmView(Request $request)
    {
        $user = null;
        if ($request->user) {
            $user = User::find($request->user);
        }elseif ($request->mobile){
            $user= User::where(['mobile' => $request->mobile, 'type' => $request->type])->first();
        }
        return view('front.auth.confirm', compact('user'));
    }

    public function confirmPhone(CheckCodeRequest $request)
    {
        $code = (int)implode('', $request->code);
        if (\auth()->check()) {
            if (\auth()->user()->verifiy_code == $code) {
                \auth()->user()->verifiy_code = null;
                \auth()->user()->verified = 1;
                \auth()->user()->save();
                session()->forget('resend');
                return redirect(route('home'))->with('success', trans('api.account_verified'));
            } else {
                return back()->withErrors(trans('api.verification_code_error'));
            }
        } elseif ($request->mobile && isset($request->type)) {
            $user = User::where(['mobile' => $request->mobile, 'type' => $request->type])->first();
            if ($user && $user->verifiy_code == $code) {
                session()->forget('resend');
                return redirect()->action([AuthController::class, 'resetPasswordView'], ['user' => $user]);
            } else {
                return redirect()->action([AuthController::class, 'confirmView'], ['user' => $user])->withErrors(trans('api.verification_code_error'));
            }
        } else {
            return back()->with(['mobile' => $request->mobile, 'type' => $request->type])->withErrors(trans('admin.login_first'));
        }
    }

    public function resendCode(Request $request)
    {
        if (\auth()->check()) {
            $user = \auth()->user();
        } else {
            $user = User::where(['mobile' => $request->mobile, 'type' => $request->type])->first();
        }
        if ($user) {
            if ($user->verifiy_code == null) {
                $user->verifiy_code = $this->userRepo->quickRandom();
                $user->save();
            }
            SMS::send($user->mobile, Messages::Code . $user->verifiy_code);
            //ToDo If Has Code Send It If Not Add New Code
            //TODO Send Sms To User Mobile
            ResendSession::check();
        } else {
            return back()->with('error', trans('api.some_thing_wrong'));
        }
        return redirect()->action([AuthController::class, 'confirmView'], ['user' => $user])->with('success', trans('api.verification_send'));
    }

    public function forgetPassword(Request $request)
    {
        $user = User::where(['mobile' => $request->mobile])->first();
        if ($user && $user->verified == 1) {
            $user->verifiy_code = $this->userRepo->quickRandom();
            $user->save();
            SMS::send($user->mobile, Messages::Code . $user->verifiy_code);
            //TODO Send SMS with Code
            session()->flash('success', trans('api.verification_send'));
            return redirect()->action([AuthController::class, 'confirmView'], ['user' => $user]);
        } elseif (!$user) {
            return back()->withErrors(trans('api.mobile_not_found'));
        } elseif ($user->verified == 0) {
            return back()->withErrors(trans('admin.not_verify_user'));
        }
    }

    public function resetPasswordView(Request $request)
    {
        if (\auth()->check()) {
            return back();
        }
        $user = null;
        if ($request->user) $user = User::find($request->user);
        return view('front.auth.reset', compact('user'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        if ($user = User::where(['mobile' => $request->mobile, 'type' => $request->type])->first()) {
            $user->password = $request->validated()['password'];
            $user->verifiy_code = null;
            $user->save();
            Auth::login($user);
            return response(['status' => 200, 'message' => trans('api.password_changed'), 'url' => route('home')], 200);
        } else {
            return response(['status' => 400, 'message' => trans('api.some_thing_wrong')], 200);
        }
    }

    public function logout()
    {
        Auth::logout();
        return back()->with('success', trans('admin.logout'));
    }

}
