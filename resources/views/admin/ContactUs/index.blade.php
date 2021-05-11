@extends('admin.layouts.master')
@section('title', __('admin.contactus'))
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <h4 class="page-title">@lang('admin.contactus')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                        {{--@can('add_categories')--}}
                        {{--<a href="{{ route('contactus.create') }}" class="btn btn-custom  waves-effect waves-light">--}}
                            {{--<span class="m-l-5"><i--}}
                                    {{--class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>--}}
                        {{--@endcan--}}
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.contactus')</h4>
                <div class="tabel-resp">
                    {{--@can('list_categories')--}}
                    <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.name')}}</th>
                            <th>{{trans('admin.email')}}</th>
                            <th>{{trans('admin.mobile')}}</th>
                            <th>{{trans('admin.title')}}</th>
                            <th>{{trans('admin.message')}}</th>
                            <th>{{trans('admin.date')}}</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contact as $item)
                            <tr {{($item->read_at==null)?'style=background-color:#1ebcd085;!important':''}}>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email}}</td>
                                <td>{{ $item->mobile}}</td>
                                <td>{{ $item->title}}</td>
                                <td>{{ substr($item->message,0,50)}}</td>
                                <td>{{ $item->created_at->toDateString()}}</td>
                                <td>
                                    <a class="btn btn-xs btn btn-icon btn-info waves-effect waves-light" href="{{route('view-contact',$item->id)}}"><i
                                            class="fa {{$item->reply?'fa-eye':'fa-reply'}}"></i></a>

                                    <a href="javascript:;" id="elementRow{{ $item->id }}"
                                       data-id="{{ $item->id }}"
                                       data-url="{{ route('delete-contact', $item->id) }}"
                                       class="removeElement btn btn-icon btn-trans btn-xs waves-effect waves-light btn-danger">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td>
                                <td>
                                    {{--@can('edit_categories')--}}
                                    {{--<a href="{{ route('city.edit', $item->id) }}"--}}
                                       {{--class="btn btn-icon btn-xs waves-effect btn-default">--}}
                                        {{--<i class="fa fa-edit"></i></a>--}}
                                    {{--@endcan--}}
                                    {{--<a href="{{ route('city.show', $item->id) }}"--}}
                                       {{--class="btn btn-icon btn-xs waves-effect btn-info">--}}
                                        {{--<i class="fa fa-eye"></i></a>--}}
                                    {{--                                        @can('delete_categories')--}}
                                    {{--<a href="javascript:;" id="elementRow{{ $item->id }}"--}}
                                       {{--data-id="{{ $item->id }}"--}}
                                       {{--data-url="{{ route('city.delete', $item->id) }}"--}}
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
@section('scripts')
    <script>
        $('body').on('click', '.cityStatus', function () {
            var productId = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var $tr = $(this).closest($('#cityRow2' + productId).parent().parent());
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
                                    $('#cityRow2' + productId).removeClass('btn-danger').addClass('btn-success').html('<i style="color: green"  class="fa fa-check-circle"></i>');
                                }else{
                                    $('#cityRow2' + productId).removeClass('btn-success').addClass('btn-danger').html('<i  style="color: red" class="fa fa-times-circle"></i>');
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection





