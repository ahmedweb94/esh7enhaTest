@extends('front.layouts.master')
@section('title')
    {{trans('admin.order')}}
@endsection
@section('banner')
    <div class="tab-content">
        <!--track-->
        <div class="tab-pane fade show active" id="track">
            <h4 class="header">{{trans('admin.orders')}}</h4>
            <div class="track-o">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <label>#</label>
                        <p>{{$order->id}}</p>
                    </div>
                    <div class="col-6 col-md-3 text-{{session('lang')=='en'?'right':'left'}}-xs">
                        <label>{{trans('admin.date')}}</label>
                        <p>{{$order->created_at->toDateString()}}</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <label>{{trans('admin.status')}}</label>
                        <div class="status-o">
                            @if(in_array($order->status,[\App\Helper\OrderStatus::newOrder,\App\Helper\OrderStatus::accepted]))
                            <img src="{{asset('public/assets/front/')}}/assets/imgs/profile/alert.svg" alt="">
                                <span class="purple">{{trans('admin.'.$order->status)}}</span>
                        @elseif(in_array($order->status,[\App\Helper\OrderStatus::admin_cancel,\App\Helper\OrderStatus::user_cancel]))
                            <img src="{{asset('public/assets/front/')}}/assets/imgs/profile/cancel.svg" alt="">
                                <span class="red2">{{trans('admin.'.$order->status)}}</span>
                    @elseif($order->status==\App\Helper\OrderStatus::delivered)
                        <img src="{{asset('public/assets/front/')}}/assets/imgs/profile/check.svg" alt="">
                                <span class="green">{{trans('admin.'.$order->status)}}</span>
                            @elseif($order->status==\App\Helper\OrderStatus::delivering)
                                <span class="">{{trans('admin.'.$order->status)}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 col-md-3 text-{{session('lang')=='en'?'right':''}}">
                        <label>{{trans('admin.delivery_fees')}}</label>
                        <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg" alt=""><span class="rose">{{$order->delivery_fees}}</span><span>{{trans('admin.sar')}}</span></div>
                        {{--<p>{{$order->delivery_fees}}</p>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label>{{trans('admin.total')}}</label>
                        <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg" alt=""><span class="rose">{{$order->delivery_fees+$order->price}}</span><span>{{trans('admin.sar')}}</span></div>
                    </div>
                    <div class="col-12 col-md-3">
                        <label>{{trans('admin.city')}}</label>
                        <p>({{@$order->address->city->{'name_'.session('lang')} }}/ {{@$order->address->city->region->{'name_'.session('lang')} }})</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <label>{{trans('admin.address')}}</label>
                        <p>{{@$order->address->address}} ({{@$order->address->name}})</p>
                    </div>
                </div>
                @foreach($order->details as $item)
                    <hr>
                <div class="row">
                    <div class="col-3"><img src="{{url('storage/app/public/'.$item->product->image)}}" alt=""></div>
                    <div class="col-5">
                        <label>{{trans('admin.name')}}</label>
                        <h4>{{$item->product->{'name_'.session('lang')} }}</h4>
                        <label>{{trans('admin.qty')}}</label>
                        <p>{{$item->qty}}</p>
                    </div>
                    <div class="col-4 text-right">
                        <label>{{trans('price')}}</label>
                        <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg" alt=""><span class="rose">{{$item->price*$item->qty}}</span><span>{{trans('admin.sar')}}</span></div>
                    </div>
                </div>
                    @endforeach
                <hr>
                <div class="row">
                    <div class="col-6 col-md-3">
                        <label>{{trans('admin.client')}}</label>
                        <p>{{@$order->user->name}}</p>
                    </div>
                    <div class="col-6 col-md-3 text-{{session('lang')=='en'?'right':'left'}}-xs">
                        <label>{{trans('admin.mobile')}}</label>
                        <p>{{@$order->user->mobile}}</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <label>{{trans('admin.payment_type')}}</label>
                        <p>{{trans('admin.'.$order->payment_type)}}</p>
                    </div>
                    <div class="col-6 col-md-3 text-{{session('lang')=='en'?'right':''}}">
                        <label>{{trans('admin.payment_status')}}</label>
                        <p>{{trans('admin.'.$order->payment_status)}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label>{{trans('admin.address')}}</label>
                        <div id="us1" style="height: 25rem; width: 100%;"></div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <a class="btn btn-primary" href="{{route('finish-order',$order->id)}}">{{trans('admin.delivered')}}</a>
                        <a class="btn btn-danger" onclick="openReason()">{{trans('admin.reject_delivery')}}</a>
                        <br>
                        <br>
                        <div id="rejectForm" style="display:none;">
                        <form action="{{route('reject-deliver')}}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <label class="required">{{trans('admin.reason')}}</label>
                            <textarea class="form-control cart-input" placeholder="{{trans('admin.reason')}}" name="reason" required data-parsley-required-message="{{trans('admin.required')}}"></textarea>
                            <button class="btn btn-danger" type="submit">{{trans('admin.reject_delivery')}}</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8"></script>
    <script type="text/javascript" src='{{ url('public/locationpicker.jquery.js')}}'></script>
    <script>

        function openReason()
        {
            $('#rejectForm').css('display','block');
        }

        $('#us1').locationpicker({
            location: {
                latitude: '{{@$order->address->lat}}',
                longitude: '{{@$order->address->lng}}',
            },
            radius: 200,
            markerIcon: '{{ asset('public/assets/front/assets/imgs/cart/marker.svg')}}',
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                locationNameInput: $('#addressInput')
            },
            setCurrentPosition: true,
            enableAutocomplete: true,
        });
    </script>
    @endsection
