@extends('admin.layouts.master')
@section('title', __('admin.category'))
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <h4 class="page-title">@lang('admin.category')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                        @can('add category')
                            <a href="{{ route('category.create') }}" class="btn btn-custom  waves-effect waves-light">
                            <span class="m-l-5"><i
                                    class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>
                        @endcan
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.category')</h4>
                <div class="tabel-resp">
                    @can('show category')
                        <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.name')}}</th>
                                <th>{{trans('admin.sort')}}</th>
                                <th>{{trans('admin.image')}}</th>
                                <th>{{trans('admin.status')}}</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cats as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $category->{'name_'.session('lang')} }}</td>
                                    <td>{{ $category->sort}}</td>
                                    <td><img style="width: 55px; border-radius: 50%; height: 55px;"
                                             src="{{ url('storage/app/public/'.$category->image) }}"/></td>
                                    <td><a href="javascript:;" id="categoryRow2{{ $category->id }}"
                                           data-feature="{{ $category->status }}" data-id="{{ $category->id }}"
                                           data-url="{{ route('category.status', $category->id) }}"
                                           class="categoryStatus btn btn-icon btn-default btn-trans btn-xs waves-effect waves-light {{ $category->status==1  ? "btn-success" : "btn-danger"}}">
                                            <i @if($category->status ==0) style="color: red" class="fas fa-times-circle"
                                               @else style="color: green" class="fas fa-check-circle" @endif></i>
                                        </a></td>
                                    <td>
                                        @can('edit category')
                                            <a href="{{ route('category.edit', $category->id) }}"
                                               class="btn btn-icon btn-xs waves-effect btn-default">
                                                <i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('show category')
                                            <a href="{{ route('category.show', $category->id) }}"
                                               class="btn btn-icon btn-xs waves-effect btn-info">
                                                <i class="fa fa-eye"></i></a>
                                        @endcan
                                        @can('delete category')
                                            <a href="javascript:;" id="elementRow{{ $category->id }}"
                                               data-id="{{ $category->id }}"
                                               data-url="{{ route('category.delete', $category->id) }}"
                                               class="removeElement btn btn-icon btn-trans btn-xs waves-effect waves-light btn-danger">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('body').on('click', '.categoryStatus', function () {
            var productId = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var $tr = $(this).closest($('#categoryRow2' + productId).parent().parent());
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
                                    $('#categoryRow2' + productId).removeClass('btn-danger').addClass('btn-success').html('<i style="color: green"  class="fa fa-check-circle"></i>');
                                } else {
                                    $('#categoryRow2' + productId).removeClass('btn-success').addClass('btn-danger').html('<i  style="color: red" class="fa fa-times-circle"></i>');
                                }
                            }
                            if (data.status == 400) {
                                var shortCutFunction = 'error';
                                var msg = data.message;
                                var title = '';
                                toastr.options = {
                                    positionClass: 'toast-top-left',
                                    onclick: null,
                                    "preventDuplicates": true,
                                    "preventOpenDuplicates": true
                                };
                                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                                $toastlast = $toast;
                            }
                        },
                        error: function (response) {
                            $("#btn-submit").attr('disabled', false);
                            $("#loading-spinner").fadeOut();
                            $("#error-message-wrapper").css('display', 'block');
                            $("#error-message").html('- ' + response.errors);
                            errors = response.responseJSON.errors;
                            showErrors(errors[Object.keys(errors)[0]][0]);
                        }
                    });
                }
            });
        });
    </script>
@endsection





