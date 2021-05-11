@extends('front.layouts.master')
@section('title')
    {{trans('admin.profile')}}
@endsection
@section('banner')
    @include('front.profile.header')
    <div class="tab-content">
        <!--track-->
        <div class="tab-pane fade show active" id="track">
            <h4 class="header">{{trans('admin.orders')}}</h4>
            @foreach($orders as $order)
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
                    <div class="col-6 col-md-6">
                        <label>{{trans('admin.total')}}</label>
                        <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg" alt=""><span class="rose">{{$order->delivery_fees+$order->price}}</span><span>{{trans('admin.sar')}}</span></div>
                    </div>
                    <div class="col-6 col-md-6">
                        <label>{{trans('admin.address')}}</label>
                        <p>{{$order->address->address}} ({{$order->address->name}})</p>
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
            </div>
            @endforeach
        </div>
    </div>
    </section>
@endsection
