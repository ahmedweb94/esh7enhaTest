@extends('admin.layouts.master')
@section('title', __('admin.admins'))
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
                @can('add admin')
                <a href="{{ route('admin.create') }}" class="btn btn-custom  waves-effect waves-light">
                    <span class="m-l-5"><i class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>
                    @endcan
            </div>
            <h4 class="page-title">@lang('admin.admins')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.admins')</h4>
                <div class="tabel-resp">
                    @can('show admin')
                    <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.name')}}</th>
                            <th>{{trans('admin.mobile')}}</th>
                            <th>{{trans('admin.email')}}</th>
                            <th>{{trans('admin.roles')}}</th>
                            <th>{{trans('admin.status')}}</th>
                            <th>{{trans('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{!! $item->name !!}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{$item->email}}</td>
                                    <td>@foreach($item->roles as $it)
                                            <span class="label label-info">{{$it->name}}</span>
                                        @endforeach
                                    </td>
                                <td id="status{{$item->id}}">{{$item->active==1?trans('admin.active'):trans('admin.not_active')}}</td>
                                <td>
                                    @if($item->id!=1)
                                        @can('edit admin')
                                            <a style="{{$item->active==0?'display:none':''}}" href="#custom-modal{{ $item->id }}" data-type="0"
                                               data-animation="scale" data-plugin="custommodal"
                                               data-overlaySpeed="100" data-overlayColor="#36404a"
                                               class="btn btn-xs btn-danger danger suspend{{$item->id}}"
                                               data-original-title="{{trans('admin.t_in_active')}}"
                                               data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="top" title="">
                                                <i class="fa fa-lock"></i>
                                            </a>
                                            <a style="{{$item->active==1?'display:none':''}}" data-type="1" data-url="{{ route('admin.status',$item->id) }}"
                                               id="suspendElementReason" class="btn btn-xs btn-success success unsuspend{{$item->id}}"
                                               data-original-title="{{trans('admin.t_active')}}" data-id="{{ $item->id }}"
                                               data-toggle="tooltip" data-placement="top"
                                               title=""> <i class="fa fa-unlock"></i></a>

                                            <a href="{{route('admin.edit',$item->id)}}" class="btn btn-xs btn-info">
                                                <i class="fa fa-edit"></i></a>

                                        @endcan
                                        @can('delete admin')
                                                <a href="javascript:;" id="elementRow{{ $item->id }}"
                                                   data-id="{{ $item->id }}"
                                                   data-url="{{ route('admin.delete', $item->id) }}"
                                                   class="removeElement btn btn-icon btn-trans btn-xs waves-effect waves-light btn-danger">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                @endcan
                                @endif
                                <td>
                                        <!-- Modal -->
                                            <div id="custom-modal{{ $item->id }}" class="modal-demo">
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
                                                    <textarea class="form-control" id="reasonSuspend{{ $item->id }}"
                                                              required
                                                              rows="5"></textarea>
                                                                <p style="display: none;"
                                                                   id="errorMessageRequired{{ $item->id }}">@lang('admin.required')</p>
                                                                <input type="hidden"
                                                                       id="isSuspendReason{{ $item->id }}"
                                                                       value="1"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-b-0">
                                                            <div>
                                                                <button type="submit"
                                                                        data-url="{{ route('admin.status',$item->id) }}"
                                                                        id="suspendElementReason"
                                                                        data-id="{{ $item->id }}"
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
                    $("#btn-submit").attr('disabled', true);
                    $("#loading-spinner").fadeIn();
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {id: id, reason: reason},
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if (data.status == 200) {
                                $("#btn-submit").attr('disabled', false);
                                $("#loading-spinner").fadeOut();
                                showMessage(data.message, 'success');
                                Custombox.close();
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
                $("#btn-submit").attr('disabled', true);
                $("#loading-spinner").fadeIn();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {id: id, reason: reason},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.status == 200) {
                            $("#btn-submit").attr('disabled', false);
                            $("#loading-spinner").fadeOut();
                            showMessage(data.message, 'success');
                            Custombox.close();
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





