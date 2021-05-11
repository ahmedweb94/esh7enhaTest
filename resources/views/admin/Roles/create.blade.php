@extends('admin.layouts.master')
@section('title', __('admin.add') .' '.__('admin.role'))
@section('content')
    <form class="submission-form" data-parsley-validate novalidate method="POST"
          action="{{ isset($role)?route('role.update',$role->id):route('role.store') }}"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    @isset($role)
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
                <h4 class="page-title">@lang('admin.admin')</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">{{__('admin.add') .' '.__('admin.role')}}</h4>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.name')}}* </label>
                            <input type="text" name="name" value="{{isset($role)?$role->name: old('name') }}"
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
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="userName">{{trans('admin.permissions')}}*</label>
                            <br>
                            <label><input id="selectAll" type="checkbox">
                                {{trans('admin.all')}}</label>
                            <br>

                            @foreach($permissions as $permission)
                                <label style="width:32%; display: inline-block"><input
                                        type="checkbox" name="permissions[]" {{isset($role)?(in_array($permission->id,$rolePermissions)?'checked':''):''}}
                                        value="{{$permission->id}}">
                                    {{trans('perm.'.$permission->name)}}</label>
                            @endforeach
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('permissions'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('permissions') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group text-right m-b-0 ">
                            <button class="btn btn-primary waves-effect waves-light m-t-20"
                                    type="submit">{{isset($role)?trans('admin.edit'):trans('admin.add')}}</button>
                            <a href="{{ route('admin.index') }}"
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
        $("#selectAll").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

        });
    </script>
@endsection





