@extends('front.layouts.authMaster')
@section('title',trans('admin.register'))
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
                            <h3 class="header2">
                                @if(session('lang')=='en')
                                    <span>V</span>erification Code
                                @else
                                    {{trans('admin.verification_code')}}
                                @endif
                            </h3>
                            <form method="post" id="confirmForm" action="{{route('post-mobile-confirm')}}"
                                  {{--class="submission-form"--}}
                                  enctype="multipart/form-data">
                                @csrf
                                <div id="confirm-box">
                                    @if((isset($user)&& $user!=null)||!auth()->check())
                                        <input type="hidden" name="mobile" value="{{@$user->mobile}}">
                                        <input type="hidden" name="type" value="{{@$user->type}}">
                                    @elseif(isset($mobile))
                                        <input type="hidden" name="mobile" value="{{@$mobile}}">
                                        <input type="hidden" name="type" value="{{@$type}}">
                                    @endif
                                    <input type="text"  name="code[]" pattern="d*" maxlength="1">
                                    <input type="text"  name="code[]" pattern="d*" maxlength="1">
                                    <input type="text"  name="code[]" pattern="d*" maxlength="1">
                                    <input type="text" name="code[]" pattern="d*" maxlength="1">
                                </div>
                                <button class="btn-rose full" type="button" id="submitConfirmForm">{{trans('admin.confirm')}}</button>
                            </form>
                            <div class="resend">
                                <form id="resend-code-form" action="{{route('resend-code')}}" method="post">
                                    {{--@dd($mobile)--}}
                                    @csrf
                                    @if((isset($user)&& $user!=null)||!auth()->check())
                                        <input type="hidden" name="mobile" value="{{@$user->mobile}}">
                                        <input type="hidden" name="type" value="{{@$user->type}}">
                                        @elseif(isset($mobile))
                                        <input type="hidden" name="mobile" value="{{@$mobile}}">
                                        <input type="hidden" name="type" value="{{@$type}}">
                                    @endif
                                    <div id="sendCode" style="display: none">
                                        <a href="javascript:;" onclick="event.preventDefault();
                                                     document.getElementById('resend-code-form').submit();"
                                           style="color: #fff">
                                            <img
                                                src="{{asset('public/assets/front/')}}/assets/imgs/register/refresh.svg"
                                                alt="">
                                            {{trans('admin.resend')}}</a>
                                    </div>
                                    <span class="rose" id="timer">@if(!session('resend') || in_array(session('resend'),[1,2])) 00:59 @else 59:59 @endif </span>
                                </form>
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
@section('js')
<script>
    $('#submitConfirmForm').on('click',function (e) {
        e.preventDefault();
        var input=$("input[name='code[]']")
            .map(function(){return $(this).val();}).get();
        var filtered = input.filter(function (el) {
            return el != "";
        });
        if(filtered.length==4){
            $('#confirmForm').submit();
        }else{
            swal("", "{{trans('admin.all_input_required')}}", "error", {button: '{{trans('admin.ok')}}'});
        }
    })
</script>
@endsection
