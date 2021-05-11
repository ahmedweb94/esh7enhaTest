@extends('admin.layouts.master')
@section('title', __('admin.country'))
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <h4 class="page-title">@lang('admin.country')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                        {{--@can('add country')--}}
                            <a href="{{ route('country.create') }}" class="btn btn-custom  waves-effect waves-light">
                            <span class="m-l-5"><i
                                    class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>
                        {{--@endcan--}}
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.country')</h4>
                <div class="tabel-resp">
                    {{--@can('show country')--}}
                        <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.name')}}</th>
                                <th>{{trans('admin.code')}}</th>
                                <th>{{trans('admin.status')}}</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($countries as $country)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ @$country->translate(app()->getLocale())->name }}</td>
                                    <td>{{ $country->code }}</td>
                                    <td><a href="javascript:;" id="countryRow2{{ $country->id }}"
                                           data-feature="{{ $country->is_active }}" data-id="{{ $country->id }}"
                                           data-url="{{ route('country.status', $country->id) }}"
                                           class="countryStatus btn btn-icon btn-default btn-trans btn-xs waves-effect waves-light {{ $country->is_active==1  ? "btn-success" : "btn-danger"}}">
                                            <i @if($country->is_active ==0) style="color: red" class="fas fa-times-circle"
                                               @else style="color: green" class="fas fa-check-circle" @endif></i>
                                        </a></td>
                                    <td>
                                        {{--@can('edit country')--}}
                                            <a href="{{ route('country.edit', $country->id) }}"
                                               class="btn btn-icon btn-xs waves-effect btn-default">
                                                <i class="fa fa-edit"></i></a>
                                        {{--@endcan--}}
                                        {{--<a href="{{ route('country.show', $country->id) }}"--}}
                                        {{--class="btn btn-icon btn-xs waves-effect btn-info">--}}
                                        {{--<i class="fa fa-eye"></i></a>--}}
                                        {{--@can('delete country')--}}
                                            <a href="javascript:;" id="elementRow{{ $country->id }}"
                                               data-id="{{ $country->id }}"
                                               data-url="{{ route('country.delete', $country->id) }}"
                                               class="removeElement btn btn-icon btn-trans btn-xs waves-effect waves-light btn-danger">
                                                <i class="fa fa-remove"></i>
                                            </a>
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
@section('scripts')
    <script>
        $('body').on('click', '.countryStatus', function () {
            var productId = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var $tr = $(this).closest($('#countryRow2' + productId).parent().parent());
            swal({
                title: "{{trans('admin.are_you_sure')}}",
                text: "{{trans('admin.change_status_message')}}",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{trans('admin.sure')}}",
                cancelButtonText: "{{trans('admin.close')}}",
                confirmButtonClass: 'btn-info waves-effect waves-light',
                closeOnConfirm: true,
                closeOnCancel: true,
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {productId},
                        dataType: 'json',
                        success: function (data) {
                            if (data.status == 200) {
                                showMessage(data.message, 'success');
                                if (data.item == 1) {
                                    $('#countryRow2' + productId).removeClass('btn-danger').addClass('btn-success').html('<i style="color: green"  class="fa fa-check-circle"></i>');
                                } else {
                                    $('#countryRow2' + productId).removeClass('btn-success').addClass('btn-danger').html('<i  style="color: red" class="fa fa-times-circle"></i>');
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection





