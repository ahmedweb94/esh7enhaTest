@extends('admin.layouts.master')
@section('title', __('admin.add') .' '.__('admin.region'))
@section('content')
    <form class="submission-form" data-parsley-validate novalidate method="POST"
          action="{{ isset($region)?route('region.update',$region->id):route('region.store') }}"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    @isset($region)
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
                <h4 class="page-title">@lang('admin.region')</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-2">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">{{__('admin.add') .' '.__('admin.region')}}</h4>
                    <div class="col-xs-5">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.name_en')}}* </label>
                            <input type="text" name="name_en" value="{{isset($region)?$region->name_en: old('name_en') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.name_en')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('name_en'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('name_en') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.name_ar')}}* </label>
                            <input type="text" name="name_ar" value="{{isset($region)?$region->name_ar: old('name_ar') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.name_ar')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('name_ar'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('name_ar') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.code')}}*</label>
                            <input name="code" class="form-control" placeholder="{{trans('admin.code')}}"
                                   required data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="10" value="{{isset($region)?$region->code: old('code') }}"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'10','value'=>trans('admin.char')])}}">
                            <p class="help-block" id="error_userName"></p>
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
                                    type="submit">{{isset($region)?trans('admin.edit'):trans('admin.add')}}</button>
                            <a href="{{ route('region.index') }}"
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





