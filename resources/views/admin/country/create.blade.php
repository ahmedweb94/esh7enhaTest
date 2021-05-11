@extends('admin.layouts.master')
@section('title', __('admin.add') .' '.__('admin.country'))
@section('content')
    <form class="submission-form" data-parsley-validate novalidate method="POST"
          action="{{ isset($country)?route('country.update',$country->id):route('country.store') }}"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    @isset($country)
        {{ method_field('PUT') }}
    @endisset
    <!-- Page-Title -->
        <div class="row">
            <div class="col-lg-10 col-lg-offset-2">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> {{trans('admin.back')}} <span
                            class="m-l-5"><i
                                class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">@lang('admin.country')</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-2">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">{{__('admin.add') .' '.__('admin.country')}}</h4>
                    @foreach(config('translatable.locales') as $key=>$value)
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.name')}}- ({{trans('admin.'.$value)}})* </label>
                            <input type="text" name="{{$key}}[name]" value="{{isset($country)?@$country->translate($key)->name: old($key."[name]") }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.name')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has($key.'.name'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first($key.'.name') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    {{--<div class="col-xs-4">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="userName">{{trans('admin.name')}}- ({{trans('admin.en')}})* </label>--}}
                            {{--<input type="text" name="name:en" value="{{isset($country)?@$country->translate('en')->name: old("name:en") }}"--}}
                                   {{--class="form-control" required--}}
                                   {{--placeholder="{{trans('admin.name')}}"--}}
                                   {{--data-parsley-trigger="keyup"--}}
                                   {{--data-parsley-required-message="{{trans('admin.required')}}"--}}
                                   {{--data-parsley-maxlength="20"--}}
                                   {{--data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"--}}
                                   {{--data-parsley-minlength="3"--}}
                                   {{--data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"--}}
                            {{--/>--}}
                            {{--@if($errors->has('name:en'))--}}
                                {{--<p class="help-block validationStyle">--}}
                                    {{--{{ $errors->first('name:en') }}--}}
                                {{--</p>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="userName">{{trans('admin.name')}}- ({{trans('admin.ar')}})* </label>--}}
                            {{--<input type="text" name="name:ar" value="{{isset($country)?@$country->translate('ar')->name: old("name:ar") }}"--}}
                                   {{--class="form-control" required--}}
                                   {{--placeholder="{{trans('admin.name')}}"--}}
                                   {{--data-parsley-trigger="keyup"--}}
                                   {{--data-parsley-required-message="{{trans('admin.required')}}"--}}
                                   {{--data-parsley-maxlength="20"--}}
                                   {{--data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"--}}
                                   {{--data-parsley-minlength="3"--}}
                                   {{--data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"--}}
                            {{--/>--}}
                            {{--@if($errors->has('name:ar'))--}}
                                {{--<p class="help-block validationStyle">--}}
                                    {{--{{ $errors->first('name:ar') }}--}}
                                {{--</p>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="userName">{{trans('admin.name')}}- ({{trans('admin.ur')}})* </label>--}}
                            {{--<input type="text" name="name:ur" value="{{isset($country)?@$country->translate('ur')->name: old("name:ur") }}"--}}
                                   {{--class="form-control" required--}}
                                   {{--placeholder="{{trans('admin.name')}}"--}}
                                   {{--data-parsley-trigger="keyup"--}}
                                   {{--data-parsley-required-message="{{trans('admin.required')}}"--}}
                                   {{--data-parsley-maxlength="20"--}}
                                   {{--data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"--}}
                                   {{--data-parsley-minlength="3"--}}
                                   {{--data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"--}}
                            {{--/>--}}
                            {{--@if($errors->has('name:ur'))--}}
                                {{--<p class="help-block validationStyle">--}}
                                    {{--{{ $errors->first('name:ur') }}--}}
                                {{--</p>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.code')}}* </label>
                            <input type="text" name="code" value="{{isset($country)?$country->code: old('code') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.code')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="2"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'2','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('code'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('code') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group text-right m-b-0 ">
                            <button class="btn btn-primary waves-effect waves-light m-t-20"
                                    type="submit">{{isset($country)?trans('admin.edit'):trans('admin.add')}}</button>
                            <a href="{{ route('country.index') }}"
                               class="btn btn-default waves-effect waves-light m-l-5 m-t-20"> @lang('admin.cancel')
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </form>
@endsection
@section('scripts')
    <script type="text/javascript"
            src="{{ request()->root() }}/public/assets/admin/js/validate-{{ session('lang') }}.js"></script>
    <script type="text/javascript">
    </script>
@endsection





