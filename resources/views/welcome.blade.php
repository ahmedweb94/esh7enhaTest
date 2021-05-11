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
    <!--featured-products-->
    <section class="featured-pro">
        <div class="container">
            <h3 class="header2"><span>F</span>EATURED <span>P</span>RODUCTS</h3>
            <div id="fe-pro">
                <div class="f-product">
                    <div class="pro-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/rose1@2x.png">
                        <button class="btn-icon rose btn-like"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>Red Roze</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">10</span><span>SAR</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right">
                            <button class="btn-icon green"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="f-product">
                    <div class="pro-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/rose2@2x.png">
                        <button class="btn-icon rose btn-like liked"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>Red Roze</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">10</span><span>SAR</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right"><span class="rose">out of stok</span>
                            <button class="btn-icon green disabled"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="f-product">
                    <div class="pro-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/rose3@2x.png">
                        <button class="btn-icon rose btn-like"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>Red Roze</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">10</span><span>SAR</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right">
                            <button class="btn-icon green"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="f-product">
                    <div class="pro-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/rose1@2x.png">
                        <button class="btn-icon rose btn-like"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>Red Roze</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">10</span><span>SAR</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right">
                            <button class="btn-icon green"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="f-product">
                    <div class="pro-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/rose2@2x.png">
                        <button class="btn-icon rose btn-like"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>Red Roze</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">10</span><span>SAR</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right">
                            <button class="btn-icon green"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="f-product">
                    <div class="pro-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/rose3@2x.png">
                        <button class="btn-icon rose btn-like liked"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>Red Roze</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">10</span><span>SAR</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right"><span class="rose">out of stok</span>
                            <button class="btn-icon green disabled"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="f-product">
                    <div class="pro-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/rose1@2x.png">
                        <button class="btn-icon rose btn-like"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>Red Roze</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">10</span><span>SAR</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right">
                            <button class="btn-icon green"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="f-product">
                    <div class="pro-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/rose2@2x.png">
                        <button class="btn-icon rose btn-like"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>Red Roze</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">10</span><span>SAR</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right">
                            <button class="btn-icon green"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="f-product">
                    <div class="pro-img-wrap"><img
                            src="{{asset('public/assets/front/')}}/assets/imgs/home/rose3@2x.png">
                        <button class="btn-icon rose btn-like"><img
                                src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg" alt=""></button>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-8 col-lg-6">
                            <h4>Red Roze</h4>
                            <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                    alt=""><span class="rose">10</span><span>SAR</span></div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-6 text-right">
                            <button class="btn-icon green"><img
                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--category-->
    <section class="category">
        <div class="row">
            <div class="col-md-8">
                <div class="offset-md-1 col-md-11">
                    <h3 class="header2 green">Category Name here</h3>
                    <p class="sub-head">that everyone understands without the<span>need for an interpreter</span></p>
                    <div class="mr-b-30">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="f-product"><a href="#">
                                        <div class="pro-img-wrap"><img
                                                src="{{asset('public/assets/front/')}}/assets/imgs/home/cat1@2x.png">
                                            <button class="btn-icon rose btn-like"><img
                                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg"
                                                    alt=""></button>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-md-8 col-lg-6">
                                                <h4>Red Roze</h4>
                                                <div class="price"><img
                                                        src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                        alt=""><span class="rose">10</span><span>SAR</span></div>
                                            </div>
                                            <div class="col-6 col-md-4 col-lg-6 text-right">
                                                <button class="btn-icon green"><img
                                                        src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg"
                                                        alt=""></button>
                                            </div>
                                        </div>
                                    </a></div>
                                <div class="f-product"><a href="#">
                                        <div class="pro-img-wrap"><img
                                                src="{{asset('public/assets/front/')}}/assets/imgs/home/cat2@2x.png">
                                            <button class="btn-icon rose btn-like"><img
                                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg"
                                                    alt=""></button>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-md-8 col-lg-6">
                                                <h4>Red Roze</h4>
                                                <div class="price"><img
                                                        src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                        alt=""><span class="rose">10</span><span>SAR</span></div>
                                            </div>
                                            <div class="col-6 col-md-4 col-lg-6 text-right">
                                                <button class="btn-icon green"><img
                                                        src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg"
                                                        alt=""></button>
                                            </div>
                                        </div>
                                    </a></div>
                            </div>
                            <div class="col-md-6 mr-t-30">
                                <div class="f-product"><a href="#">
                                        <div class="pro-img-wrap"><img
                                                src="{{asset('public/assets/front/')}}/assets/imgs/home/cat3@2x.png">
                                            <button class="btn-icon rose btn-like"><img
                                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg"
                                                    alt=""></button>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-md-8 col-lg-6">
                                                <h4>Red Roze</h4>
                                                <div class="price"><img
                                                        src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                        alt=""><span class="rose">10</span><span>SAR</span></div>
                                            </div>
                                            <div class="col-6 col-md-4 col-lg-6 text-right">
                                                <button class="btn-icon green"><img
                                                        src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg"
                                                        alt=""></button>
                                            </div>
                                        </div>
                                    </a></div>
                                <div class="f-product"><a href="#">
                                        <div class="pro-img-wrap"><img
                                                src="{{asset('public/assets/front/')}}/assets/imgs/home/cat4@2x.png">
                                            <button class="btn-icon rose btn-like"><img
                                                    src="{{asset('public/assets/front/')}}/assets/imgs/home/like.svg"
                                                    alt=""></button>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-md-8 col-lg-6">
                                                <h4>Red Roze</h4>
                                                <div class="price"><img
                                                        src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg"
                                                        alt=""><span class="rose">10</span><span>SAR</span></div>
                                            </div>
                                            <div class="col-6 col-md-4 col-lg-6 text-right">
                                                <button class="btn-icon green"><img
                                                        src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg"
                                                        alt=""></button>
                                            </div>
                                        </div>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 padd-0">
                <div class="green-side"></div>
            </div>
        </div>
    </section>
@endsection
