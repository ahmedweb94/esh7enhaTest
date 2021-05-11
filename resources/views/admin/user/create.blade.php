@extends('admin.layouts.master')
@section('title', __('admin.add') .' '.__('admin.driver'))
@section('content')
    <form class="submission-form" data-parsley-validate novalidate method="POST"
          action="{{ isset($driver)?route('driver.update',$driver->id):route('driver.store') }}"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    @isset($driver)
        {{ method_field('PUT') }}
    @endisset
    <!-- Page-Title -->
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> {{trans('admin.back')}} <span
                            class="m-l-5"><i
                                class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">@lang('admin.driver')</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">{{__('admin.add') .' '.__('admin.driver')}}</h4>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.name')}}* </label>
                            <input type="text" name="name" value="{{isset($driver)?$driver->user->name: old('name') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.name')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('name'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.mobile')}}* </label>
                            <input type="number" name="mobile" value="{{isset($driver)?$driver->user->mobile: old('mobile') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.mobile')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-type-message="{{trans('admin.required_number')}}"
                                   data-parsley-maxlength="15"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'15','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="9"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'9','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('mobile'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('mobile') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.identity')}}* </label>
                            <input type="number" name="identity" value="{{isset($driver)?$driver->identity: old('identity') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.identity')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-type-message="{{trans('admin.required_number')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="8"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'8','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('identity'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('identity') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.vehicle_type')}}* </label>
                            <input type="text" name="vehicle_type" value="{{isset($driver)?$driver->vehicle_type: old('vehicle_type') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.vehicle_type')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('vehicle_type'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('vehicle_type') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.vehicle_number')}}* </label>
                            <input type="text" name="vehicle_number" value="{{isset($driver)?$driver->vehicle_number: old('vehicle_number') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.vehicle_number')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-maxlength="20"
                                   data-parsley-maxlength-message="{{trans('admin.max',['max'=>'20','value'=>trans('admin.char')])}}"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('vehicle_number'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('vehicle_number') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.identity_image')}}*</label>
                            <input type="file" accept="image/*" name="identity_image" class="form-control"/>

                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('identity_image'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('identity_image') }}
                                </p>
                            @endif
                        </div>
                        @if(isset($driver) &&$driver->identity_image)
                            <img style="width: 75px; height: 75px;"
                                 src="{{ url('storage/app/public/'.$driver->identity_image) }}"/>
                        @endif
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.vehicle_image')}}*</label>
                            <input type="file" accept="image/*" name="vehicle_image" class="form-control"/>

                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('vehicle_image'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('vehicle_image') }}
                                </p>
                            @endif
                        </div>
                        @if(isset($driver) &&$driver->vehicle_image)
                            <img style="width: 75px; height: 75px;"
                                 src="{{ url('storage/app/public/'.$driver->vehicle_image) }}"/>
                        @endif
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group text-right m-b-0 ">
                            <button class="btn btn-primary waves-effect waves-light m-t-20"
                                    type="submit">{{isset($driver)?trans('admin.edit'):trans('admin.add')}}</button>
                            <a href="{{ route('driver.index') }}"
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





