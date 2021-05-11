@extends('front.layouts.authMaster')
@section('title',trans('admin.login'))
@section('css')
    <style>
        .login-img-wrap img {
            height: auto;
        }

        .login .pretty {
            margin: 0 0 7px;
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
                        <div class="login-logo" style="cursor: pointer;" onclick="window.location.href='{{url('/')}}'"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/register/logo@2x.png" alt=""></div>
                        <!--login-->
                        <section class="login">
                            <h3 class="header2">@if(session('lang')=='en')<span>W</span>elcome Again @else
                                    <span>م</span>رحبا مجددا  @endif</h3>
                            <form method="post" action="{{route('post-login')}}"
                                  class="submission-form"
                                  enctype="multipart/form-data">
                                @csrf
                                <label class="required">{{trans('admin.mobile')}}</label>
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
                                <div class="row">
                                    <div class="col-6">
                                        <label class="required">{{trans('admin.password')}}</label>
                                    </div>
                                </div>
                                <input class="form-control cart-input mr-b-10" type="password"
                                       placeholder="{{trans('admin.password')}}" name="password" required
                                       data-parsley-trigger="keyup"
                                       data-parsley-required-message="{{trans('admin.required')}}">
                                <div class="row">
                                    <div class="offset-6 col-6 text-right mr-b-15">
                                        <a class="white" href="{{route('forget-password')}}">
                                            {{trans('admin.forget_password')}}</a>
                                    </div>
                                </div>
                                <div class="pretty p-default mr-b-15">
                                    <input type="checkbox" value="1" name="remember">
                                    <div class="state">
                                        <label>{{trans('admin.remember_me')}}</label>
                                    </div>
                                </div>
                                <button class="btn-rose full" type="submit">{{trans('admin.login')}}</button>
                            </form>

                            <div class="sign-up text-center">
                                <p>{{trans('admin.dont_have_account')}} <a class="rose"
                                                                           href="{{route('register')}}">{{trans('admin.sign_up')}}</a>
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="offset-lg-1 col-md-6">
                    <div class="login-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/register/login-img@2x.png" alt=""></div>
                </div>
            </div>
        </div>
    </main>
@endsection
