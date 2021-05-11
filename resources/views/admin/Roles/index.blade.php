@extends('admin.layouts.master')
@section('title', __('admin.roles'))
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
                @can('add role')
                    <a href="{{ route('role.create') }}" class="btn btn-custom  waves-effect waves-light">
                        <span class="m-l-5"><i class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>
                @endcan
            </div>
            <h4 class="page-title">@lang('admin.roles')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.roles')</h4>
                <div class="tabel-resp">
                    @can('show role')
                    <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.role')}}</th>
                            <th>{{trans('admin.date')}}</th>
                            <th>{{trans('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->created_at}}</td>
                                <td>
                                    @can('edit role')
                                        <a class="btn btn-xs btn-info btn-icon waves-effect waves-light"
                                           href="{{route('role.edit',$role->id)}}">
                                            <i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('delete role')
                                        <a href="javascript:;" id="elementRow{{ $role->id }}"
                                           data-id="{{ $role->id }}"
                                           data-url="{{ route('role.delete', $role->id) }}"
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
    <script src="{{ request()->root() }}/public/assets/admin/plugins/custombox/dist/custombox.min.js"></script>
    <script src="{{ request()->root() }}/public/assets/admin/plugins/custombox/dist/legacy.min.js"></script>
    <script>
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
                }
            } else {
                reason = '';
            }
            $.ajax({
                type: 'POST',
                url: url,
                data: {id: id, reason: reason},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.status == 200) {
                        showMessage(data.message, 'success');
                        Custombox.close();
                        $("#reasonSuspend" + id).val("");
                        if (data.item == 1) {
                            $('#status' + id).html('{{trans('admin.active')}}');
                            $('.suspend' + id).removeAttr('style');
                            $('.unsuspend' + id).css('display', 'none');
                        } else {
                            Custombox.close();
                            $('#status' + id).html('{{trans('admin.not_active')}}');
                            $('.unsuspend' + id).removeAttr('style');
                            $('.suspend' + id).css('display', 'none');
                        }
                    }
                }
            });
        });
    </script>
@endsection
