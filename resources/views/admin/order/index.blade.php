@extends('admin.layouts.master')
@section('title', __('admin.order'))
@section('styles')
    <link href="{{ request()->root() }}/public/assets/admin/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="btn-group pull-right m-t-15 ">
                {{--<a href="{{ route('order.create') }}" class="btn btn-custom  waves-effect waves-light">--}}
                {{--<span class="m-l-5"><i--}}
                {{--class="fa fa-plus"></i> <span>{{trans('admin.add')}}</span> </span></a>--}}
            </div>
            <h4 class="page-title">@lang('admin.order')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <div class="btn-group pull-right">
                        <form class="form-inline" role="form" action="{{ route('order.index') }}" method="get">
                            <div class="row">
                                <div class="form-group">
                                    <select class="form-control" name="city_id">
                                        <option value="">{{trans('admin.all_cities')}}</option>
                                        @foreach($cities as $city)
                                            <option
                                                value="{{ $city->id }}" {{ request('city_id') == $city->id ? "selected" : "" }}>{{ $city->{'name_'.session('lang')} }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="user_id">
                                        <option value="">{{trans('admin.all_users')}}</option>
                                        @foreach($users as $user)
                                            <option
                                                value="{{ $user->id }}" {{ request('user_id') == $user->id ? "selected" : "" }}>
                                                {{ $user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="payment_type">
                                        <option value="">{{trans('admin.all_payment_type')}}</option>
                                        <option value="cash" {{ request('payment_type') == 'cash' ? "selected" : "" }}>
                                            {{ trans('admin.cash')}}</option>
                                        <option
                                            value="credit" {{ request('payment_type') == 'credit' ? "selected" : "" }}>
                                            {{ trans('admin.credit')}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="status">
                                        @foreach(\App\Helper\OrderStatus::arr as $key=>$value)
                                            <option value="{{$key}}"
                                                {{request('status')?(request('status') == $key ? "selected" : ""):(($key=='new')?'selected':'') }}>
                                                {{ trans('admin.'.$value)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" value="{{ request('from') }}" name="from">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" value="{{ request('to') }}" name="to">
                                </div>
                                <button type="submit"
                                        class="btn btn-success waves-effect waves-light m-l-10 btn-md">{{trans('admin.filter')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <h4 class="header-title m-t-0 m-b-30">@lang('admin.order')</h4>
                <div class="tabel-resp">
                    @can('show order')
                    <table class="table m-0  table-striped table-hover table-condensed" id="datatable-fixed-header">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('admin.id')}}</th>
                            <th>{{trans('admin.city')}}</th>
                            <th>{{trans('admin.status')}}</th>
                            <th>{{trans('admin.date')}}</th>
                            <th>{{trans('admin.delivery_time')}}</th>
                            <th>{{trans('admin.user')}}</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr id="orderRow{{$order->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$order->id}}</td>
                                <td>{{ @$order->address->city->{'name_'.session('lang')} }}</td>
                                <td>{{trans('admin.'.$order->status) }}</td>
                                <td>{{$order->created_at->toDateString() }}</td>
                                <td>{{$order->delivery_time }} {{trans('admin.hour')}}</td>
                                <td>{{@$order->user->name }}</td>
                                <td>
                                    @can('edit order')
                                    @if($order->status==\App\Helper\OrderStatus::newOrder)
                                        <form method="post" action="{{ route('order.accept', $order->id) }}"
                                              class="submission-form" id="acceptOrder{{$order->id}}">
                                            @csrf
                                            <input type="hidden" name="status" value="{{\App\Helper\OrderStatus::accepted}}">
                                        </form>
                                        <a onclick="event.preventDefault();
                                            document.getElementById('acceptOrder{{$order->id}}').submit();"
                                           class="btn btn-icon btn-xs waves-effect btn-success">
                                            {{trans('admin.accept_order')}}</a>

                                        <a id="rejectOrder" href="#cancel-order" data-id="{{$order->id}}"
                                           data-url="{{ route('order.reject',$order->id) }}"
                                           data-animation="fadein" data-plugin="custommodal"
                                           data-overlaySpeed="200" data-overlayColor="#36404a"
                                           class="btn btn-icon btn-xs waves-effect btn-danger">
                                            {{trans('admin.reject_order')}}</a>

                                    @elseif($order->status==\App\Helper\OrderStatus::accepted)
                                        <a id="assignOrder" href="#drivers{{$order->id}}" data-id="{{$order->id}}"
                                           data-animation="fadein" data-plugin="custommodal"
                                           data-overlaySpeed="200" data-overlayColor="#36404a"
                                           class="btn btn-icon btn-xs waves-effect btn-primary">
                                            {{trans('admin.assign_to_driver')}}</a>
                                    @endif
                                    @endcan
                                    @can('show order')
                                    <a href="{{ route('order.show', $order->id) }}"
                                       class="btn btn-icon btn-xs waves-effect btn-info">
                                        <i class="fa fa-eye"></i></a>
                                    @endcan
                                </td>
                            </tr>

                            <div id="drivers{{$order->id}}" class="modal-demo">
                                <button type="button" class="close" onclick="Custombox.close();">
                                    <span>&times;</span><span class="sr-only">Close</span>
                                </button>
                                <h4 class="custom-modal-title">{{trans('admin.assign_to_driver')}}</h4>
                                <div class="custom-modal-text" id="modalContent">
                                    <form class="submission-form2" data-parsley-validate novalidate method="POST"
                                          action="{{ route('order.assign') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <!-- Page-Title -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                                    <div class="col-xs-12 text-{{session('lang')=='en'?'right':'left'}} ">
                                                        <div class="form-group">
                                                            <label for="userName">{{trans('admin.driver')}}*</label>
                                                            <select name="driver_id" class="form-control" required
                                                                    data-parsley-required-message="{{trans('admin.required')}}">
                                                                <option value="">{{trans('admin.select_driver')}}...</option>
                                                                @foreach($drivers as $driver)
                                                                    <option value="{{$driver->id}}">{{$driver->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <p class="help-block" id="error_userName"></p>
                                                            @if($errors->has('driver_id'))
                                                                <p class="help-block validationStyle">
                                                                    {{ $errors->first('driver_id') }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <div class="form-group text-right m-b-0 ">
                                                            <button class="btn btn-primary waves-effect waves-light m-t-20"
                                                                    type="submit">{{isset($city)?trans('admin.edit'):trans('admin.add')}}</button>
                                                            <a href="{{ route('city.index') }}"
                                                               class="btn btn-default waves-effect waves-light m-l-5 m-t-20"> @lang('admin.cancel')
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                    @endcan
                    <div id="cancel-order" class="modal-demo">
                        <button type="button" class="close" onclick="Custombox.close();">
                            <span>&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="custom-modal-title">{{trans('admin.reject_order')}}</h4>
                        <div class="custom-modal-text">
                            <form method="post" enctype="multipart/form-data"
                                  data-parsley-validate
                                  novalidate
                                  {{--class="submission-form2"--}}
                            >
                                @csrf
                                <input type="hidden" name="orderStatus" value="cancel"/>
                                <div class="col-xs-12 text-left">
                                    <div class="form-group">
                                        <input type="hidden" name="status" value="{{\App\Helper\OrderStatus::admin_cancel}}">
                                        <label for="userName">{{trans('admin.reason')}}</label>
                                        <textarea name="reason" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group text-right">
                                    <img id="indicatorImage" src="{{ request()->root() }}/public/assets/images/spinner.gif"
                                         style="width: 50px; height: 50px; display: none; margin-top: 20px;">
                                    <button class="btn btn-primary waves-effect waves-light m-t-20" id="btnRegister"
                                            type="submit">
                                        {{trans('admin.save')}}</button>
                                    <button onclick="Custombox.close();" type="reset"
                                            class="btn btn-default waves-effect waves-light m-l-5 m-t-20">{{trans('admin.cancel')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ request()->root() }}/public/assets/admin/plugins/custombox/dist/custombox.min.js"></script>
    <script src="{{ request()->root() }}/public/assets/admin/plugins/custombox/dist/legacy.min.js"></script>
    <script>
        $('#rejectOrder').on('click', function (e) {
            var action = $(this).attr('data-url');
            e.preventDefault();
            $('#cancel-order').find('form').attr('action', action);
        });

        {{--$('#assignOrder').on('click', function (e) {--}}
            {{--var order=$(this).attr('data-id');--}}
            {{--e.preventDefault();--}}
            {{--$.ajax({--}}
                {{--type: 'GET',--}}
                {{--url: '{{url('admin/get/driver/')}}/'+order,--}}
                {{--dataType: 'json',--}}
                {{--success: function (data) {--}}
                    {{--if (data.status == 200) {--}}
                        {{--// $('#drivers').Custombox.open();--}}
                        {{--if (data.data) {--}}
                            {{--$('#modalContent').html(data.data);--}}
                        {{--}--}}
                    {{--}--}}
                {{--}--}}
        {{--});--}}
        {{--});--}}
        $('.submission-form2').on('submit', function (e) {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();
            e.preventDefault();
            var formData = new FormData(this);
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()) {
                $("#btn-submit").attr('disabled', true);
                $("#loading-spinner").fadeIn();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 200) {
                            Custombox.close();
                           $('#orderRow'+data.item).fadeOut(1000, function () {
                               $('#orderRow'+data.item).remove();
                            });
                            $("#btn-submit").attr('disabled', false);
                            $("#loading-spinner").fadeOut();
                            $("#error-message-wrapper").css('display', 'none');
                            var shortCutFunction = 'success';
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
                            if (data.url) {
                                setTimeout(function () {
                                    window.location.href = data.url;
                                }, 1000);
                            } else {
                                $('.hide-modal').modal('hide');
                            }
                        }
                    },
                    error: function (response) {
                        Custombox.close();
                        $("#btn-submit").attr('disabled', false);
                        $("#loading-spinner").fadeOut();
                        $("#error-message-wrapper").css('display', 'block');
                        $("#error-message").html('- ' + response.errors);
                        errors = response.responseJSON.errors;
                        showErrors(errors[Object.keys(errors)[0]][0]);
                    }
                });
            } else {
                $("#btn-submit").attr('disabled', false);
            }
        });
    </script>
@endsection
