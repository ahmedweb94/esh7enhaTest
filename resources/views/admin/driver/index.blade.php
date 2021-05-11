@extends('admin.layouts.master')
@section('title', __('admin.drivers'))
@section('styles')
    <!-- Custom box css -->
    <link href="{{ request()->root() }}/public/assets/admin/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
    <style>
        .errorValidationReason {
            border: 1px solid red;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="btn-group pull-right m-t-15 ">
                @can('add driver')
                    <a href="{{ route('driver.create') }}" class="btn btn-custom  waves-effect waves-light">
                        <span class="m-l-5"><i class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>
                @endcan
            </div>
            <h4 class="page-title">@lang('admin.drivers')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                        {{--@can('add_categories')--}}
                        <form class="form-inline" role="form" action="{{ route('driver.index') }}" method="get">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="{{trans('admin.mobile')}}"
                                       name="mobile" value="{{request('mobile')}}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ request('name') }}"
                                       name="name" placeholder="{{trans('admin.name')}}">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="status">
                                    <option value="">{{trans('admin.status')}}..</option>
                                    <option
                                        {{!request('status')?'selected':(request('status')=='1'?'selected':'')}} value="1">{{trans('admin.active')}}</option>
                                    <option
                                        {{(request('status')=='0'?'selected':'')}} value="0">{{trans('admin.not_active')}}</option>
                                </select>
                            </div>
                            <button type="submit"
                                    class="btn btn-success waves-effect waves-light m-l-10 btn-md">{{trans('admin.filter')}}
                            </button>
                        </form>
                        {{--@endcan--}}
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.drivers')</h4>
                <div class="tabel-resp">
                    @can('show driver')
                        <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.name')}}</th>
                                <th>{{trans('admin.mobile')}}</th>
                                <th>{{trans('admin.orders_number')}}</th>
                                <th>{{trans('admin.date')}}</th>
                                <th>{{trans('admin.status')}}</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($drivers as $driver)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $driver->user->name }}</td>
                                    <td>{{ $driver->user->mobile}}</td>
                                    <td><a href="{{route('order-drivers',['driver',$driver->user->id])}}">{{$driver->user->driver_orders->count()??0}}</a></td>
                                    <td>{{$driver->created_at->toDateString()}}</td>
                                    <td id="status{{$driver->id}}">{{$driver->user->active==1?trans('admin.active'):trans('admin.not_active')}}</td>
                                    <td>
                                        <a href="{{ route('driver.show', $driver->id) }}"
                                           class="btn btn-icon btn-xs waves-effect btn-info">
                                            <i class="fa fa-eye"></i></a>
                                        @can('edit driver')
                                            <a href="{{ route('driver.edit', $driver->id) }}"
                                               class="btn btn-icon btn-xs waves-effect btn-default">
                                                <i class="fa fa-edit"></i></a>


                                            <a style="{{$driver->user->active==0?'display:none':''}}"
                                               href="#custom-modal{{ $driver->id }}" data-type="0"
                                               data-animation="scale" data-plugin="custommodal"
                                               data-overlaySpeed="100" data-overlayColor="#36404a"
                                               class="btn btn-xs btn-danger danger suspend{{$driver->id}}"
                                               data-original-title="{{trans('admin.t_in_active')}}"
                                               data-id="{{ $driver->id }}" data-toggle="tooltip" data-placement="top"
                                               title="">
                                                <i class="fa fa-lock"></i>
                                            </a>
                                            <a style="{{$driver->user->active==1?'display:none':''}}" data-type="1"
                                               data-url="{{ route('driver.status',$driver->id) }}"
                                               id="suspendElementReason"
                                               class="btn btn-xs btn-success success unsuspend{{$driver->id}}"
                                               data-original-title="{{trans('admin.t_active')}}"
                                               data-id="{{ $driver->id }}"
                                               data-toggle="tooltip" data-placement="top"
                                               title=""> <i class="fa fa-unlock"></i></a>
                                        @endcan
                                    <!-- Modal -->
                                        <div id="custom-modal{{ $driver->id }}" class="modal-demo">
                                            <button type="button" class="close" onclick="Custombox.close();">
                                                <span>&times;</span><span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="custom-modal-title">{{trans('admin.t_in_active')}}</h4>
                                            <div class="custom-modal-text"
                                                 style="text-align: right;">
                                                <form>
                                                    <div class="form-group">
                                                        <label>{{trans('admin.reason')}}</label>
                                                        <div>
                                                    <textarea class="form-control" id="reasonSuspend{{ $driver->id }}"
                                                              required
                                                              rows="5"></textarea>
                                                            <p style="display: none;"
                                                               id="errorMessageRequired{{ $driver->id }}">@lang('admin.required')</p>
                                                            <input type="hidden"
                                                                   id="isSuspendReason{{ $driver->id }}"
                                                                   value="1"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-b-0">
                                                        <div>
                                                            <button type="submit"
                                                                    data-url="{{ route('driver.status',$driver->id) }}"
                                                                    id="suspendElementReason"
                                                                    data-id="{{ $driver->id }}"
                                                                    data-type="0"
                                                                    class="btn btn-info waves-effect waves-light">
                                                                {{trans('admin.t_in_active')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--endModel-->
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
    <script src="{{ request()->root() }}/public/assets/admin/plugins/custombox/dist/custombox.min.js"></script>
    <script src="{{ request()->root() }}/public/assets/admin/plugins/custombox/dist/legacy.min.js"></script>
    <script>
        $('body').on('click', '.driverStatus', function () {
            var productId = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var $tr = $(this).closest($('#driverRow2' + productId).parent().parent());
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
                                    $('#driverRow2' + productId).removeClass('btn-danger').addClass('btn-success').html('<i style="color: green"  class="fa fa-check-circle"></i>');
                                } else {
                                    $('#driverRow2' + productId).removeClass('btn-success').addClass('btn-danger').html('<i  style="color: red" class="fa fa-times-circle"></i>');
                                }
                            }
                        }
                    });
                }
            });
        });

        $('body').delegate('#suspendElementReason', 'click', function (e) {
            {{--$("#suspendElementReason").html('{{ __('trans.processing') }}');--}}
            e.preventDefault();

            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            var url = $(this).attr('data-url');
            var reason = $("#reasonSuspend" + id).val();
            var isReason = $("#isSuspendReason" + id).val();
            if (type == 0) {
                if (reason == "") {
                    $("#reasonSuspend" + id).css("border", "1px solid red");
                    $("#errorMessageRequired" + id).fadeIn();
                } else {
                    $("#reasonSuspend" + id).css("border", "1px solid #E3E3E3");
                    $("#errorMessageRequired" + id).fadeOut();
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {id: id, reason: reason},
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if (data.status == 200) {
                                showMessage(data.message, 'success');
                                $("#reasonSuspend" + id).val("");
                                if (data.item == 1) {
                                    $('#status' + id).html('{{trans('admin.active')}}');
                                    $('.suspend' + id).removeAttr('style');
                                    $('.unsuspend' + id).css('display','none');
                                } else {
                                    Custombox.close();
                                    $('#status' + id).html('{{trans('admin.not_active')}}');
                                    $('.unsuspend' + id).removeAttr('style');
                                    $('.suspend' + id).css('display','none');
                                }
                            }
                        }
                    });
                }
            } else {
                reason = '';
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {id: id, reason: reason},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.status == 200) {
                            showMessage(data.message, 'success');
                            $("#reasonSuspend" + id).val("");
                            if (data.item == 1) {
                                $('#status' + id).html('{{trans('admin.active')}}');
                                $('.suspend' + id).removeAttr('style');
                                $('.unsuspend' + id).css('display','none');
                            } else {
                                Custombox.close();
                                $('#status' + id).html('{{trans('admin.not_active')}}');
                                $('.unsuspend' + id).removeAttr('style');
                                $('.suspend' + id).css('display','none');
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection





