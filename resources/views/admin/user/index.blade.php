@extends('admin.layouts.master')
@section('title', __('admin.users'))
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
                {{--<a href="{{ route('user.create') }}" class="btn btn-custom  waves-effect waves-light">--}}
                    {{--<span class="m-l-5"><i class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>--}}
            </div>
            <h4 class="page-title">@lang('admin.users')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                        {{--@can('add_categories')--}}
                        <form class="form-inline" role="form" action="{{ route('user.index') }}" method="get">
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
                                    <option {{!request('status')?'selected':(request('status')=='1'?'selected':'')}} value="1">{{trans('admin.active')}}</option>
                                    <option {{(request('status')=='0'?'selected':'')}} value="0">{{trans('admin.not_active')}}</option>
                                </select>
                            </div>
                            <button type="submit"
                                    class="btn btn-success waves-effect waves-light m-l-10 btn-md">{{trans('admin.filter')}}
                            </button>
                        </form>
                        {{--@endcan--}}
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.users')</h4>
                <div class="tabel-resp">
                    <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.name')}}</th>
                            <th>{{trans('admin.mobile')}}</th>
                            <th>{{trans('admin.orders_number')}}</th>
                            <th>{{trans('admin.date')}}</th>
                            <th>{{trans('admin.code')}}</th>
                            <th>{{trans('admin.status')}}</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->mobile}}</td>
                                <td><a href="{{route('order-drivers',['user',$user->id])}}">{{$user->orders_count}}</a></td>
                                <td>{{$user->created_at->toDateString()}}</td>
                                <td>{{$user->verifiy_code}}</td>
                                <td id="status{{$user->id}}">{{$user->active==1?trans('admin.active'):trans('admin.not_active')}}</td>
                                <td>
                                    {{--@can('edit_categories')--}}
                                    {{--<a href="{{ route('user.edit', $user->id) }}"--}}
                                       {{--class="btn btn-icon btn-xs waves-effect btn-default">--}}
                                        {{--<i class="fa fa-edit"></i></a>--}}
                                    @can('show users')
                                    <a href="{{ route('user.show', $user->id) }}"
                                       class="btn btn-icon btn-xs waves-effect btn-info">
                                        <i class="fa fa-eye"></i></a>
                                    @endcan
                                    @can('edit users')
                                        <a style="{{$user->active==0?'display:none':''}}" href="#custom-modal{{ $user->id }}" data-type="0"
                                           data-animation="scale" data-plugin="custommodal"
                                           data-overlaySpeed="100" data-overlayColor="#36404a"
                                           class="btn btn-xs btn-danger danger suspend{{$user->id}}"
                                           data-original-title="{{trans('admin.t_in_active')}}"
                                           data-id="{{ $user->id }}" data-toggle="tooltip" data-placement="top" title="">
                                            <i class="fa fa-lock"></i>
                                        </a>
                                        <a style="{{$user->active==1?'display:none':''}}" data-type="1" data-url="{{ route('user.status',$user->id) }}"
                                           id="suspendElementReason" class="btn btn-xs btn-success success unsuspend{{$user->id}}"
                                           data-original-title="{{trans('admin.t_active')}}" data-id="{{ $user->id }}"
                                           data-toggle="tooltip" data-placement="top"
                                           title=""> <i class="fa fa-unlock"></i></a>
                                    @endcan
                                        <!-- Modal -->
                                            <div id="custom-modal{{ $user->id }}" class="modal-demo">
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
                                                    <textarea class="form-control" id="reasonSuspend{{ $user->id }}"
                                                              required  data-parsley-trigger="keyup"
                                                              data-parsley-required-message="{{trans('admin.required')}}"
                                                              rows="5"></textarea>
                                                                <p style="display: none;"
                                                                   id="errorMessageRequired{{ $user->id }}">@lang('admin.required')</p>
                                                                <input type="hidden"
                                                                       id="isSuspendReason{{ $user->id }}"
                                                                       value="1"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-b-0">
                                                            <div>
                                                                <button type="submit"
                                                                        data-url="{{ route('user.status',$user->id) }}"
                                                                        id="suspendElementReason"
                                                                        data-id="{{ $user->id }}"
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
                    {{--@endcan--}}
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





