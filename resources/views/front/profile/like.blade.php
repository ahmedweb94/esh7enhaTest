@extends('front.layouts.master')
@section('title')
    {{trans('admin.profile')}}
@endsection
@section('banner')
    @include('front.profile.header')
    <div class="tab-content">
        <!--favorite-->
        <div class="tab-pane fade show active" id="favorite">
            <h4 class="header">{{trans('admin.your_favorite_list')}}</h4>
            @if($liked->count()>0)
                <div class="row">
                    @foreach($liked as $item)
                        <div class="col-6 col-md-4" id="profileLike{{$item->product_id}}">
                            <div class="f-product">
                                <div class="pro-img-wrap">
                                    <img src="{{ url('storage/app/public/'.$item->product->image) }}"></div>
                                <div class="row">
                                    <div class="col-8">
                                        <h4>{{$item->product->{'name_'.session('lang')} }}</h4>
                                        <div class="price"><img
                                                src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                alt=""><span
                                                class="rose">{{$item->product->price}}</span><span>{{trans('admin.sar')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-4 text-right">
                                        <button class="btn-icon rose btn-like liked"
                                                data-product="{{$item->product_id}}"><img
                                                src="{{asset('public/assets/front/')}}/assets/imgs/home/liked.svg"
                                                alt=""></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h5 class="text-center">{{trans('admin.favorite_empty')}}</h5>
            @endif
        </div>
    </div>
    </section>
@endsection
