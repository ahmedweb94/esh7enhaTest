@extends('admin.layouts.master')
@section('title', __('admin.product'))
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="btn-group pull-right m-t-15 ">
                @can('add product')
                    <a href="{{ route('product.create') }}" class="btn btn-custom  waves-effect waves-light">
                            <span class="m-l-5"><i
                                    class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>
                @endcan
            </div>
            <h4 class="page-title">@lang('admin.product')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                        <form class="form-inline" role="form" action="{{ route('product.index') }}" method="get">
                            <div class="form-group">
                                <select class="form-control" id="selectMainCategory" name="cat_id">
                                    <option value="">{{trans('admin.category')}}</option>
                                    @foreach($cats as $mainCategory)
                                        <option
                                            value="{{ $mainCategory->id }}" {{ request('cat_id') == $mainCategory->id ? "selected" : "" }}>{{ $mainCategory->{'name_'.session('lang')} }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" min="1" class="form-control" value="{{ request('price') }}"
                                       name="price" id="productprice" placeholder="{{trans('admin.price')}}">
                            </div>
                            <button type="submit"
                                    class="btn btn-success waves-effect waves-light m-l-10 btn-md">{{trans('admin.filter')}}
                            </button>
                        </form>
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.product')</h4>
                <div class="tabel-resp">
                    @can('show product')
                        <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.image')}}</th>
                                <th>{{trans('admin.name')}}</th>
                                <th>{{trans('admin.price')}}</th>
                                <th>{{trans('admin.status')}}</th>
                                <th>{{trans('admin.empty?')}}</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><img style="width: 55px; border-radius: 50%; height: 55px;"
                                             src="{{ url('storage/app/public/'.$product->image) }}"/></td>
                                    <td>{{ $product->{'name_'.session('lang')} }}</td>
                                    <td>{{ $product->price}}</td>
                                    <td><a href="javascript:;" id="productRow2{{ $product->id }}"
                                           data-feature="{{ $product->status }}" data-id="{{ $product->id }}"
                                           data-url="{{ route('product.status', $product->id) }}"
                                           class="productStatus btn btn-icon btn-default btn-trans btn-xs waves-effect waves-light {{ $product->status==1  ? "btn-success" : "btn-danger"}}">
                                            <i @if($product->status ==0) style="color: red" class="fas fa-times-circle"
                                               @else style="color: green" class="fas fa-check-circle" @endif></i>
                                        </a></td>
                                    <td><a href="javascript:;" id="productRow{{ $product->id }}"
                                           data-feature="{{ $product->empty }}" data-id="{{ $product->id }}"
                                           data-url="{{ route('product.empty', $product->id) }}"
                                           class="productEmpty btn btn-icon btn-default btn-trans btn-xs waves-effect waves-light {{ $product->empty==0  ? "btn-success" : "btn-danger"}}">
                                            <i @if($product->empty ==1) style="color: red" class="fas fa-battery-empty"
                                               @else style="color: green" class="fas fa-battery-full" @endif></i>
                                        </a></td>
                                    <td>
                                        @can('edit product')
                                            <a href="{{ route('product.edit', $product->id) }}"
                                               class="btn btn-icon btn-xs waves-effect btn-default">
                                                <i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('show product')
                                            <a href="{{ route('product.show', $product->id) }}"
                                               class="btn btn-icon btn-xs waves-effect btn-info">
                                                <i class="fa fa-eye"></i></a>
                                        @endcan
                                            @can('delete product')
                                        <a href="javascript:;" id="elementRow{{ $product->id }}"
                                           data-id="{{ $product->id }}"
                                           data-url="{{ route('product.delete', $product->id) }}"
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
        $('body').on('click', '.productStatus', function () {
            var productId = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var $tr = $(this).closest($('#productRow2' + productId).parent().parent());
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
                                    $('#productRow2' + productId).removeClass('btn-danger').addClass('btn-success').html('<i style="color: green"  class="fa fa-check-circle"></i>');
                                } else {
                                    $('#productRow2' + productId).removeClass('btn-success').addClass('btn-danger').html('<i  style="color: red" class="fa fa-times-circle"></i>');
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
        $('body').on('click', '.productEmpty', function () {
            var productId = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var $tr = $(this).closest($('#productRow' + productId).parent().parent());
            swal({
                title: "{{trans('admin.are_you_sure')}}",
                text: "{{trans('admin.change_product_empty_message')}}",
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
                                if (data.item == 0) {
                                    $('#productRow' + productId).removeClass('btn-danger').addClass('btn-success').html('<i style="color: green"  class="fas fa-battery-full"></i>');
                                } else {
                                    $('#productRow' + productId).removeClass('btn-success').addClass('btn-danger').html('<i  style="color: red" class="fas fa-battery-empty"></i>');
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





