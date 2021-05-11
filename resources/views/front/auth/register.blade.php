@extends('front.layouts.authMaster')
@section('title',trans('admin.register'))
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
                        <!--register-->
                        <section class="login step" id="step-1">
                            <h3 class="header2">@if(session('lang')=='en')<span>N</span>ew Account @else {{trans('admin.new_account')}}@endif</h3>
                            <form method="post" action="{{route('post-register')}}"
                                  class="submission-form"
                                  enctype="multipart/form-data">
                                @csrf
                            <label class="required">{{trans('admin.name')}}</label>
                            <input class="form-control cart-input" required name="name" placeholder="{{trans('admin.name')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                            >
                            <label class="required">{{trans('admin.phone')}}</label>
                            <input class="form-control cart-input" name="mobile" type="number" required placeholder="{{trans('admin.phone')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required_number')}}"
                                   data-parsley-type-message="{{trans('admin.required_number')}}"
                                   data-parsley-maxlength="10"
                                   data-parsley-pattern="/(05)[0-9]{8}/"
                                   data-parsley-pattern-message="{{trans('admin.number_start')}}"
                                   data-limit="10"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'10','value'=>trans('admin.number')])}}"
                                   data-parsley-minlength="5"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'5','value'=>trans('admin.number')])}}">
                            <label class="required">{{trans('admin.password')}}</label>
                            <input class="form-control cart-input" name="password" type="password" placeholder="{{trans('admin.password')}}"
                                   required
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-minlength="6"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'6','value'=>trans('admin.char')])}}">
                            <label class="required">{{trans('admin.password_confirmation')}}</label>
                            <input class="form-control cart-input" name="password_confirmation" type="password" placeholder="{{trans('admin.password_confirmation')}}"
                                   required
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-minlength="6"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'6','value'=>trans('admin.char')])}}">
                                    <input required  data-parsley-required-message="{{trans('admin.required')}}" type="checkbox" class="cart-input" value="1" name="terms">
                                        <label>{{trans('admin.accept')}} <span><a href="{{route('terms')}}" target="_blank">{{trans('admin.terms')}} </a> </span></label>
                                <br>
                                <br>
                            <button class="btn-rose full next-step-btn" type="submit">{{trans('admin.register')}}</button>
                            </form>
                            <div class="sign-up text-center">
                                <p>{{trans('admin.have_account')}} <a class="rose" href="{{route('login')}}">{{trans('admin.login')}}</a></p>
                            </div>
                        </section>
                        {{--<section class="login step" id="step-2">--}}
                            {{--<h3 class="header2"><span>V</span>erification Code</h3>--}}
                            {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>--}}
                            {{--<div id="confirm-box">--}}
                                {{--<input type="text" pattern="d*" maxlength="1">--}}
                                {{--<input type="text" pattern="d*" maxlength="1">--}}
                                {{--<input type="text" pattern="d*" maxlength="1">--}}
                                {{--<input type="text" pattern="d*" maxlength="1">--}}
                            {{--</div>--}}
                            {{--<button class="btn-rose full">confirm</button>--}}
                            {{--<div class="resend"><img src="{{asset('public/assets/front/')}}/assets/imgs/register/refresh.svg" alt=""><span>Resend</span><span class="rose" id="timer">00:59</span></div>--}}
                        {{--</section>--}}
                    </div>
                </div>
                <div class="offset-lg-1 col-md-6">
                    <div class="login-img-wrap"><img src="{{asset('public/assets/front/')}}/assets/imgs/register/login-img@2x.png" alt=""></div>
                </div>
            </div>
        </div>
    </main>
@endsection
