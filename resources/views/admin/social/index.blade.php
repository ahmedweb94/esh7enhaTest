@extends('admin.layouts.master')
@section('title', __('admin.social_pages'))
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <h4 class="page-title">@lang('admin.social_pages')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                        {{--@can('add_categories')--}}
                        {{--<a href="{{ route('social_pages.create') }}" class="btn btn-custom  waves-effect waves-light">--}}
                        {{--<span class="m-l-5"><i--}}
                        {{--class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>--}}
                        {{--@endcan--}}
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.social_pages')</h4>
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
                        @foreach($pages as $pages)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{trans('admin.'.$pages->index)}}</td>
                                <td>{!! $pages->value !!}</td>
                                <td>
                                    {{--@can('edit_categories')--}}
                                    <a href="{{ route('social.edit', $pages->id) }}"
                                       class="btn btn-icon btn-xs waves-effect btn-default">
                                        <i class="fa fa-edit"></i></a>
                                    {{--@endcan--}}
                                    {{--<a href="{{ route('pages.show', $pages->id) }}"--}}
                                    {{--class="btn btn-icon btn-xs waves-effect btn-info">--}}
                                    {{--<i class="fa fa-eye"></i></a>--}}
                                    {{--                                        @can('delete_categories')--}}
                                    {{--<a href="javascript:;" id="elementRow{{ $pages->id }}"--}}
                                    {{--data-id="{{ $pages->id }}"--}}
                                    {{--data-url="{{ route('pages.delete', $pages->id) }}"--}}
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

