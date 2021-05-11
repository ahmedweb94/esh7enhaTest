@extends('admin.layouts.master')
@section('title', __('admin.edit') .' '.__('admin.social_pages'))
@section('content')
    <form class="submission-form" data-parsley-validate novalidate method="POST"
          action="{{ isset($page)?route('social.update',$page->id):route('page.store') }}"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    @isset($page)
        {{--{{ method_field('PUT') }}--}}
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
                <h4 class="page-title">@lang('admin.social_pages')</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-2">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">{{__('admin.'.$page->index)}}</h4>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.value')}} * </label>
                            <input type="url" name="value" value="{{$page->value}}" required class="form-control" data-parsley-required-message="{{trans('admin.required')}}" data-parsley-type-message="{{trans('admin.required_url')}}">
                            @if($errors->has('value'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('value') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group text-right m-b-0 ">
                            <button class="btn btn-primary waves-effect waves-light m-t-20"
                                    type="submit">{{isset($page)?trans('admin.edit'):trans('admin.add')}}</button>
                            <a href="{{ route('page.index') }}"
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
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
    </script>
@endsection



