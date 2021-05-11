@extends('admin.layouts.login')
@section('content')
    <div class="m-t-40 card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">@lang('institutioncp.reset_password') </h4>
            {{--<p class="text-muted m-b-0 font-13 m-t-20">Enter your email address and we'll send you an email with instructions to reset your password.  </p>--}}
        </div>
        <div class="panel-body">
            <form class="form-horizontal m-t-20" method="POST" action="{{ route('administrator.password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="email" value="{{@$admin->email}}">
                {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                    {{--<div class="col-xs-12">--}}
                        {{--<input id="email" type="email" class="form-control" name="email"--}}
                               {{--value="{{ @$admin->email or old('email') }}" required autofocus--}}
                               {{--placeholder="من @lang('institutioncp.insert_email')...">--}}
                        {{--@if ($errors->has('email'))--}}
                            {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('email') }}</strong>--}}
                            {{--</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" name="code" required autofocus
                               placeholder=" @lang('admin.code')">
                        @if ($errors->has('code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input id="password" type="password" class="form-control" name="password" required
                               placeholder="@lang('admin.password')"  data-parsley-trigger="keyup"
                               minlength="6"
                               data-parsley-required-message="{{trans('admin.required')}}"
                               {{--data-parsley-maxlength="25"--}}
                               {{--data-parsley-maxlength-message="{{trans('admin.max',['max'=>25,'value'=>trans('admin.char')])}}"--}}
                               data-parsley-minlength="6"
                               data-parsley-minlength-message="{{trans('admin.min',['min'=>6,'value'=>trans('admin.char')])}}">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required placeholder="@lang('admin.password_confirmation')"
                               minlength="6"
                               data-parsley-trigger="keyup"
                               data-parsley-required-message="{{trans('admin.required')}}"
                               {{--data-parsley-maxlength="25"--}}
                               {{--data-parsley-maxlength-message="{{trans('admin.max',['max'=>25,'value'=>trans('admin.char')])}}"--}}
                               data-parsley-minlength="6"
                               data-parsley-minlength-message="{{trans('admin.min',['min'=>6,'value'=>trans('admin.char')])}}">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                 <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group text-center m-t-20 m-b-0">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                            @lang('institutioncp.send')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end card-box -->
@endsection
