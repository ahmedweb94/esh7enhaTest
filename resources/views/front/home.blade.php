@extends('front.layouts.master')
@section('title')
    {{trans('admin.home')}}
@endsection
@section('banner')
    @include('front.includes.banner')
@endsection
@section('css')
    <style>
    .slick-slide {
    height: auto !important;
    }
    </style>
    @endsection
@section('content')
    <main class="main-content">
        <!--modal-->
        <div class="modal fade" id="proModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" id="modalContent">

                </div>
            </div>
        </div>
        <!--section-content-->
    <!--featured-products-->
    <section class="featured-pro">
        <div class="container">
            <h3 class="header2">@if(session('lang')=='en')<span>L</span>ATEST <span>P</span>RODUCTS @else{{trans('admin.latest_product')}} @endif</h3>
            <div id="fe-pro">
                @foreach($products as $product)
                <div class="f-product" onclick="getDetails('{{route('product-details',$product->id)}}')">
                    <div class="pro-img-wrap">
                        <img src="{{ url('storage/app/public/'.$product->image) }}">
                        <button data-product="{{$product->id}}" class="btn-icon rose btn-like {{(auth()->check() && in_array($product->id,auth()->user()->liked->pluck('product_id')->toArray()))?'liked':''}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/{{(auth()->check() && in_array($product->id,auth()->user()->liked->pluck('product_id')->toArray()))?'liked.svg':'like.svg'}}" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>{{$product->{'name_'.session('lang')} }}</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">{{$product->price}}</span><span>{{trans('admin.sar')}}</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right">
                            @if($product->empty==1)
                                <span class="rose">{{trans('admin.out_of_stock')}}</span>
                            @endif
                            <button class="btn-icon green {{$product->empty==1?'disabled':''}}" data-product="{{$product->id}}"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--category-->
    <section class="category">
        <div class="row">
            <div class="col-md-8">
                <div class="offset-md-1 col-md-11">
                    <h3 class="header2 rose">{{trans('admin.categories')}}</h3>
                    {{--<p class="sub-head">that everyone understands without the<span>need for an interpreter</span></p>--}}
                    <div class="mr-b-30">
                        <div class="row">
                            @foreach($cat as $item)
                                <div class="col-md-6 {{$loop->iteration% 2==0?'mr-t-30':''}}">
                                    <div class="f-product" >
                                        <div class="pro-img-wrap" onclick="window.location.href='{{route('category-products',$item->id)}}';">
                                            {{--<a href="{{route('category-products',$item->id)}}">--}}
                                            <img src="{{ url('storage/app/public/'.$item->image) }}">
                                            {{--</a>--}}
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-md-8 col-lg-6">
                                                <a href="{{route('category-products',$item->id)}}">
                                                    <h4>{{$item->{'name_'.session('lang')} }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 padd-0">
                <div class="green-side"></div>
            </div>
        </div>
    </section>
    </main>
@endsection
@section('js')
    <script>
        $('#fe-pro').slick({
            dots: true,
            infinite: false,
            rtl:{{session('lang')=='en'?"false":"true"}},
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        rtl:{{session('lang')=='en'?"false":"true"}},
                        slidesToScroll: 2,
                        infinite: false,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        rtl:{{session('lang')=='en'?"false":"true"}},
                        slidesToScroll: 1,
                        dots: true
                    }
                }
            ]
        });

        function getDetails(route) {
            $.ajax({
                type: 'GET',
                url: route,
                success: function (data) {
                    if (data) {
                        $('#proModal').modal('show');
                        $('#modalContent').html(data);
                    }
                    if (data.status == 400) {
                        if (data.message) {
                            swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});
                        }
                        if (data.url) {
                            setTimeout(function () {
                                window.location.href = data.url;
                            }, 1000);
                        }
                    }
                },
                error: function (response) {
                    errors = response.responseJSON.errors;
                    swal("", errors[Object.keys(errors)[0]][0], "error", {button: '{{trans('admin.ok')}}'});
                }
            });

        }
    </script>
@endsection
