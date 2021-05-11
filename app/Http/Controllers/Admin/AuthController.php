<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\Admin\AdminResetPasswordRequest;
use App\Mail\ForgetPasswordMail;
use App\Models\User;
use App\Repository\AdminRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected $adminRepo;
    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo=$adminRepo;
    }

    public function loginView()
    {
        if(\auth()->guard('admin')->check()){
            return redirect(url('admin/home'));
        }else{
        return view('admin.auth.login');
        }
    }

    public function login(AdminLoginRequest $request)
    {
        if(Auth::guard('admin')->attempt(['email'=>$request->validated()['email'],'password'=>$request->validated()['password']],$request->remember)){
            return redirect(url('admin/home'));
        }else{
            return back()->withErrors(trans('admin.login_error'));
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function forgetPasswordView()
    {
        return view('admin.auth.passwords.email');
    }

    public function sendResetMail(Request $request)
    {
        if ($user = $this->adminRepo->where('email', $request->email)->first()) {
            if($user->active==1){
                $user->code = (new UserRepository(new User()))->quickRandom();
                $user->save();
                Mail::to($request->email)->send(new ForgetPasswordMail($user));
                return redirect(route('admin.reset-view', $user->id));
            }else{
                return redirect()->back()->withErrors(trans('admin.account_inactive_message') . $user->reason);
            }
        } else {
            return redirect()->back()->withErrors(trans('admin.no_user_found'));
        }
    }

    public function resetView($id)
    {
        $admin = $this->adminRepo->getById($id);
        return view('admin.auth.passwords.reset', compact('admin'));
    }

    public function resetPassword(AdminResetPasswordRequest $request)
    {
        $user=$this->adminRepo->where('email',$request->email)->first();
        if($user && $user->code==$request->code){
            $user->code=null;
            $user->password=$request->validated()['password'];
            $user->save();
            Auth::guard('admin')->login($user);
            return redirect(route('admin.home'));
        }else{
            return back()->with('error',trans('api.code_not_valid'));
        }
    }

}
