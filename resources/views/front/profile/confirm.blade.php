@extends('front.layouts.authMaster')
@section('title',trans('admin.profile'))
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
                        <div class="login-logo"><img
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
                            <form method="post" id="confirmForm" action="{{route('update-mobile')}}"
                                  class="submission-form2"
                                  enctype="multipart/form-data">
                                @csrf
                                <div id="confirm-box">
                                    <input type="text" name="code[]" pattern="d*" maxlength="1">
                                    <input type="text" name="code[]" pattern="d*" maxlength="1">
                                    <input type="text" name="code[]" pattern="d*" maxlength="1">
                                    <input type="text" name="code[]" pattern="d*" maxlength="1">
                                </div>
                                <button class="btn-rose full" id="submitConfirmForm">{{trans('admin.confirm')}}</button>
                            </form>
                            <div class="resend">
                                <form id="resend-code-form" action="{{route('resend-tmp')}}" class="submission-form"
                                      method="post">
                                    @csrf
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
        $(document).ready(function () {
            if ($('#timer').is(":visible")) {
                var timer2 = $('#timer').html();
                var interval = setInterval(function () {
                    var timer = timer2.split(':');
                    //by parsing integer, I avoid all extra string processing
                    var minutes = parseInt(timer[0], 10);
                    var seconds = parseInt(timer[1], 10);
                    --seconds;
                    minutes = (seconds < 0) ? --minutes : minutes;
                    seconds = (seconds < 0) ? 59 : seconds;
                    seconds = (seconds < 10) ? '0' + seconds : seconds;
                    //minutes = (minutes < 10) ?  minutes : minutes;
                    $('#timer').html(minutes + ':' + seconds);
                    if (minutes < 0) clearInterval(interval);
                    //check if both minutes and seconds are 0
                    if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval);
                    timer2 = minutes + ':' + seconds;
                    if (seconds == 0 && mintues==0) {
                        $('#sendCode').css('display', 'inline-block');
                    }
                }, 1000);
            }
        });
        $('.submission-form2').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var form = $(this);
            form.parsley().validate();
            var input=$("input[name='code[]']")
                .map(function(){return $(this).val();}).get();
            var filtered = input.filter(function (el) {
                return el != "";
            });
            if(filtered.length==4) {
                if (form.parsley().isValid()) {
                    $("#btn-submit").attr('disabled', true);
                    $("#loading-spinner").fadeIn();
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data.status == 200) {
                                $(form)[0].reset();
                                if (data.message) {
                                    swal("", data.message, "success", {button: '{{trans('admin.ok')}}'});
                                }
                                if (data.url) {
                                    setTimeout(function () {
                                        window.location.href = data.url;
                                    }, 1000);
                                } else {
                                    // $('.modal').modal('hide');
                                }
                            }
                            if (data.status == 400) {
                                if (data.message) {
                                    swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});
                                }
                                if (data.url) {
                                    setTimeout(function () {
                                        window.location.href = data.url;
                                    }, 1000);
                                }
                            }
                        },
                        error: function (response) {
                            errors = response.responseJSON.errors;
                            swal("", errors[Object.keys(errors)[0]][0], "error", {button: '{{trans('admin.ok')}}'});
                        }
                    });
                } else {
                    $("#btn-submit").attr('disabled', false);
                }
            }else{
                swal("", "{{trans('admin.all_input_required')}}", "error", {button: '{{trans('admin.ok')}}'});
            }
        });
    </script>
@endsection
