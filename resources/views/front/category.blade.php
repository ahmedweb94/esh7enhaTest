@extends('front.layouts.master')
@section('title')
    {{trans('admin.category')}}
@endsection
@section('css')
    <style>
    </style>
    @endsection
@section('banner')
    <!--section-content-->
    <section class="section-content custom-padd">
        <h3 class="header2 rose">{{trans('admin.all_category')}}</h3>
        {{--<p class="sub-head">that everyone understands without the<span>need for an interpreter</span></p>--}}
        <div class="mr-b-30">
            <div class="row">
                @foreach($category as $item)
                <div class="col-md-6 {{$loop->iteration% 2==0?'mr-t-30':''}}">
                    <div class="f-product">
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
            <div class="text-center">{{ $category->appends($_GET)->links()  }}</div>
        </div>
    </section>
@endsection
