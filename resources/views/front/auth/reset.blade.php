@extends('front.layouts.authMaster')
@section('title',trans('admin.forget_password'))
@section('css')
    <style>
        .login-img-wrap img {
            height: auto;
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
                        <!--register-->
                        <section class="login step">
                            <h3 class="header2">@if(session('lang')=='en')<span>N</span>ew
                                Password @else {{trans('admin.new_password')}} @endif</h3>
                            <form method="post" action="{{route('post-reset')}}"
                                  class="submission-form"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="mobile" value="{{$user->mobile}}">
                                <input type="hidden" name="type" value="{{$user->type}}">
                                <label>{{trans('admin.new_password')}}</label>
                                <input class="form-control cart-input" name="password" type="password"
                                       placeholder="{{trans('admin.password')}}"
                                       required
                                       data-parsley-trigger="keyup"
                                       data-parsley-required-message="{{trans('admin.required')}}"
                                       data-parsley-minlength="6"
                                       data-parsley-minlength-message="{{trans('admin.min',['min'=>'6','value'=>trans('admin.char')])}}">
                                <label class="required">{{trans('admin.password_confirmation')}}</label>
                                <input class="form-control cart-input" name="password_confirmation" type="password"
                                       placeholder="{{trans('admin.password_confirmation')}}"
                                       required
                                       data-parsley-trigger="keyup"
                                       data-parsley-required-message="{{trans('admin.required')}}"
                                       data-parsley-minlength="6"
                                       data-parsley-minlength-message="{{trans('admin.min',['min'=>'6','value'=>trans('admin.char')])}}">
                                <button type="submit" class="btn-rose full">{{trans('admin.change')}}</button>
                            </form>
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
@section('js')
    <script>
    </script>
@endsection
