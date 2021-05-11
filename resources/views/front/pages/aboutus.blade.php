@extends('front.layouts.master')
@section('title')
    {{trans('admin.about_us')}}
@endsection
@section('banner')
    <!--condition-content-->
    <section class="about-content custom-padd">
        <h3 class="header2 rose">{{trans('admin.about_us')}}</h3>
        {!! $item->{'value_'.session('lang')} !!}
    </section>
@endsection
