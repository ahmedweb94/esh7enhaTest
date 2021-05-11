<?php

namespace App\Http\Controllers;

use App\Helper\Messages;
use App\Helper\ResendSession;
use App\Helper\SMS;
use App\Http\Requests\Front\Profile\ChangePasswordRequest;
use App\Http\Requests\Front\Profile\UpdateMobileRequest;
use App\Http\Requests\Front\Profile\UpdateProfileRequest;
use App\Repository\UserRepository;

class ProfileController extends Controller
{

    protected $userRepo;
    public function __construct(UserRepository $cartRepo)
    {
        $this->userRepo=$cartRepo;
    }

    public function index()
    {
        return view('front.profile.index');
    }

    public function mobileConfirm()
    {
        return view('front.profile.confirm');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->userRepo->updateProfile($request->validated());
        if($request->mobile && $request->mobile != auth()->user()->mobile){
            return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('profile-confirm')],200);
        }else{
            return response(['status'=>200,'message'=>trans('admin.updated'),'confirm'=>0],200);
        }
    }

    public function resendCode()
    {
        //TODO Send SMS To User tmp_mobile
        if(!auth()->user()->verifiy_code){
            auth()->user()->verifiy_code=$this->userRepo->quickRandom();
            auth()->user()->save();
        }
        SMS::send(auth()->user()->tmp_mobile,Messages::Code.auth()->user()->verifiy_code);
        ResendSession::check();
        return redirect(route('profile-confirm'))->with('success',trans('api.verification_send'));
    }

    public function updateMobile(UpdateMobileRequest $request)
    {
        $code = (int)implode('', $request->code);
        if(auth()->user()->verifiy_code==$code){
            $data['verifiy_code']=null;
            $data['mobile']=auth()->user()->tmp_mobile;
            $data['tmp_mobile']=null;
            $this->userRepo->update(auth()->id(),$data);
            session()->forget('resend');
            return response(['status'=>200,'message'=>trans('admin.mobile_change'),'url'=>route('profile')],200);
        }else{
            return response(['status'=>400,'message'=>trans('api.verification_code_error')],200);
        }
    }

    public function password()
    {
        return view('front.profile.password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if($this->userRepo->checkPassword(auth()->user(),$request->validated())){
            return response(['status'=>200,'message'=>trans('api.password_changed')],200);
        }else{
            return response(['status'=>400,'message'=>trans('api.password_error')],200);
        }
    }

}
