@extends('admin.layouts.master')
@section('title',  __('admin.profile'))
@section('content')
    <!-- Page-Title -->
    <form class="submission-form" data-parsley-validate novalidate method="POST"
          action="{{ isset($admin)?route('admin.update',$admin->id):route('admin.store') }}"
          enctype="multipart/form-data">
        {{ csrf_field() }}
        @isset($admin)
            {{ method_field('PUT') }}
        @endisset
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="btn-group pull-right m-t-15">
                <button type="button" class="btn btn-custom  waves-effect waves-light"
                        onclick="window.history.back();return false;"> @lang('maincp.back') <span class="m-l-5"><i
                            class="fa fa-reply"></i></span>
                </button>
            </div>
            <h4 class="page-title">{{trans('admin.profile')}}</h4>
        </div>
    </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">{{__('admin.add') .' '.__('admin.admin')}}</h4>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.name')}}* </label>
                            <input type="text" name="name" value="{{isset($admin)?$admin->name: old('name') }}"
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
                            <input type="number" name="mobile" value="{{isset($admin)?$admin->mobile: old('mobile') }}"
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
                            <label for="userName">{{trans('admin.email')}}* </label>
                            <input type="email" name="email" value="{{isset($admin)?$admin->email: old('email') }}"
                                   class="form-control" required
                                   placeholder="{{trans('admin.email')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-type-message="{{trans('admin.required_email')}}"
                                   data-parsley-minlength="5"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'5','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('email'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.password')}}* </label>
                            <input type="password" name="password" class="form-control" required
                                   placeholder="{{trans('admin.password')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-minlength="6"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'6','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('password'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.password_confirmation')}}* </label>
                            <input type="password" name="password_confirmation" class="form-control" required
                                   placeholder="{{trans('admin.password_confirmation')}}"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="{{trans('admin.required')}}"
                                   data-parsley-minlength="6"
                                   data-parsley-minlength-message="{{trans('admin.min',['min'=>'6','value'=>trans('admin.char')])}}"
                            />
                            @if($errors->has('password_confirmation'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('password_confirmation') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.roles')}}*</label>
                            <br>
                            <br>
                            @foreach($admin->roles as $r)
                                <li>{{$r->name}}</li>
                            @endforeach
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('roles'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('roles') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group text-right m-b-0 ">
                            <button class="btn btn-primary waves-effect waves-light m-t-20"
                                    type="submit">{{isset($admin)?trans('admin.edit'):trans('admin.add')}}</button>
                            <a href="{{ route('admin.index') }}"
                               class="btn btn-default waves-effect waves-light m-l-5 m-t-20"> @lang('admin.cancel')
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- end col -->
        </div>
    </form>
@endsection

