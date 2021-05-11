@extends('admin.layouts.master')
@section('title', __('admin.edit') .' '.__('admin.setting'))
@section('content')
    <form class="submission-form" data-parsley-validate novalidate method="POST"
          action="{{ isset($setting)?route('setting.update',$setting->id):route('setting.store') }}"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    @isset($setting)
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
                <h4 class="page-title">@lang('admin.setting')</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-2">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">{{__('admin.edit') .' '.__('admin.setting')}}</h4>
                    <div class="col-xs-10">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.'.$setting->index)}}* </label>
                            <input type="number" step="any" name="amount"
                                   value="{{$setting->amount }}" class="form-control"
                                   required placeholder="{{trans('admin.amount')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-min=".01"
                                   data-parsley-min-message="{{trans('admin.min_num',['min'=>'.01'])}}"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-type-message="{{trans('admin.required_number')}}"
                            />
                            @if($errors->has('amount'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('amount') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="form-group">
                            <label for="userName" style="visibility: hidden">{{trans('admin.'.$setting->index)}}* </label>
                            <p>{{trans('admin.'.$setting->value)}}</p>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group text-right m-b-0 ">
                            <button class="btn btn-primary waves-effect waves-light m-t-20"
                                    type="submit">{{isset($setting)?trans('admin.edit'):trans('admin.add')}}</button>
                            <a href="{{ route('setting.index') }}"
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





