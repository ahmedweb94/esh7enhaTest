@extends('admin.layouts.master')
@section('title', __('admin.setting'))
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <h4 class="page-title">@lang('admin.setting')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                        {{--@can('add_categories')--}}
                        {{--<a href="{{ route('setting.create') }}" class="btn btn-custom  waves-effect waves-light">--}}
                            {{--<span class="m-l-5"><i--}}
                                    {{--class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>--}}
                        {{--@endcan--}}
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.setting')</h4>
                <div class="tabel-resp">
                    {{--@can('list_categories')--}}
                    <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.name')}}</th>
                            <th>{{trans('admin.value')}}</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{trans('admin.'.$setting->index)}}</td>
                                <td>{{$setting->amount}} {{$setting->value?trans('admin.'.$setting->value):''}}</td>
                                <td>
                                    {{--@can('edit_categories')--}}
                                    <a href="{{ route('setting.edit', $setting->id) }}"
                                       class="btn btn-icon btn-xs waves-effect btn-default">
                                        <i class="fa fa-edit"></i></a>
                                    {{--@endcan--}}
                                    {{--<a href="{{ route('setting.show', $setting->id) }}"--}}
                                       {{--class="btn btn-icon btn-xs waves-effect btn-info">--}}
                                        {{--<i class="fa fa-eye"></i></a>--}}
                                    {{--                                        @can('delete_categories')--}}
                                    {{--<a href="javascript:;" id="elementRow{{ $setting->id }}"--}}
                                       {{--data-id="{{ $setting->id }}"--}}
                                       {{--data-url="{{ route('setting.delete', $setting->id) }}"--}}
                                       {{--class="removeElement btn btn-icon btn-trans btn-xs waves-effect waves-light btn-danger">--}}
                                        {{--<i class="fa fa-remove"></i>--}}
                                    {{--</a>--}}
                                    {{--@endcan--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--@endcan--}}
                </div>
            </div>
        </div>
    </div>
@endsection
