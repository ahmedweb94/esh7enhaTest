@extends('front.layouts.authMaster')
@section('title',trans('admin.forget_password'))
@section('css')
    <style>
        .login-img-wrap img {
            height: auto;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <main class="reg-content">
        <div class="login-part">
            <div class="row">
                <div class="offset-md-1 col-md-5 col-lg-4">
                    <div class="register-content">
                        <div class="login-logo" style="cursor: pointer;" onclick="window.location.href='{{url('/')}}'"><img src="{{asset('public/assets/front/')}}/assets/imgs/register/logo@2x.png" alt=""></div>
                        <!--forget-pass-content-->
                        <section class="login step" id="step-1">
                            <h3 class="header2">@if(session('lang')=='en')<span>F</span>ORGOT PASSWORD? @else {{trans('admin.forget_password')}} @endif</h3>
                            <form method="post" action="{{route('post-forget-password')}}"
                                  {{--class="submission-form"--}}
                                  enctype="multipart/form-data">
                                @csrf
                            <label>{{trans('admin.phone')}}</label>
                            <input class="form-control cart-input" required name="mobile" type="number"
                                   placeholder="{{trans('admin.mobile')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-type-message="{{trans('admin.required_number')}}"
                                   data-parsley-pattern="/(05)[0-9]{8}/"
                                   data-parsley-pattern-message="{{trans('admin.number_start')}}"
                                   data-limit="10"
                                   data-parsley-maxlength="10"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'10','value'=>trans('admin.number')])}}"
                                   data-parsley-minlength="5"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'5','value'=>trans('admin.number')])}}">
                            <button class="btn-rose full next-step-btn">{{trans('admin.next')}}</button>
                            </form>
                        </section>
                        <section class="login step" id="step-2">
                            <h3 class="header2"><span>V</span>erification Code</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                            <div id="confirm-box">
                                <input type="text" pattern="d*" maxlength="1">
                                <input type="text" pattern="d*" maxlength="1">
                                <input type="text" pattern="d*" maxlength="1">
                                <input type="text" pattern="d*" maxlength="1">
                            </div>
                            <button class="btn-rose full next-step-btn">confirm</button>
                            <div class="resend"><img src="{{asset('public/assets/front/')}}/assets/imgs/register/refresh.svg" alt=""><span>Resend</span><span class="rose" id="timer">00:59</span></div>
                        </section>
                        <section class="login step" id="step-3">
                            <h3 class="header2"><span>N</span>ew Password</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <label>New Password</label>
                            <input class="form-control cart-input" type="text" placeholder="Password">
                            <label>confirm Password</label>
                            <input class="form-control cart-input" type="text" placeholder="Password">
                            <button class="btn-rose full">submit</button>
                        </section>
                    </div>
                </div>
                <div class="offset-lg-1 col-md-6">
                    <div class="login-img-wrap"><img src="{{asset('public/assets/front/')}}/assets/imgs/register/login-img@2x.png" alt=""></div>
                </div>
            </div>
        </div>
    </main>
@endsection
