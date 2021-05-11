@extends('admin.layouts.master')
@section('title', trans('admin.dashboard'))
@section('styles')
    <style>
        .text-muted {
            font-size: 13px !important;
        }
    </style>
@endsection
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">@lang('admin.dashboard')</h4>
        </div>
    </div>
    <div class="row statistics">
        {{--@can('users_management')--}}
            <div class="col-lg-3 col-md-6">
                <a href="javascript:;">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">{{trans('admin.users')}}</h4>
                        <div class="widget-box-2">
                            <div class="widget-detail-2">
                                    <span class="pull-left">
                                        <i class="zmdi zmdi-accounts zmdi-hc-4x"></i>
                                    </span>
                                <h2 class="m-b-0">{{$users }}</h2>
                                <p class="text-muted m-b-15"></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{--<div class="col-lg-3 col-md-6">--}}
                {{--<a href="javascript:;">--}}
                    {{--<div class="card-box">--}}
                        {{--<h4 class="header-title m-t-0 m-b-30">{{trans('admin.products')}}</h4>--}}
                        {{--<div class="widget-box-2">--}}
                            {{--<div class="widget-detail-2">--}}
                                    {{--<span class="pull-left">--}}
                                        {{--<i class="zmdi zmdi-flower zmdi-hc-4x"></i>--}}
                                    {{--</span>--}}
                                {{--<h2 class="m-b-0">{{ $products }}</h2>--}}
                                {{--<p class="text-muted m-b-15"></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--@endcan--}}
        {{--@can('products_management')--}}
            {{--<div class="col-lg-3 col-md-6">--}}
                {{--<a href="javascript:;">--}}
                    {{--<div class="card-box">--}}
                        {{--<h4 class="header-title m-t-0 m-b-30">{{trans('admin.categories')}}</h4>--}}
                        {{--<div class="widget-box-2">--}}
                            {{--<div class="widget-detail-2">--}}
                                    {{--<span class="pull-left">--}}
                                         {{--<i class="zmdi zmdi-format-list-bulleted zmdi-hc-4x"></i>--}}
                                        {{--<i class="zmdi zmdi-refresh-sync-problem zmdi-hc-4x"></i>--}}
                                    {{--</span>--}}
                                {{--<h2 class="m-b-0">{{ $cats }}</h2>--}}
                                {{--<p class="text-muted m-b-15"></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--@endcan--}}
        {{--@can('orders_management')--}}
            {{--<div class="col-lg-3 col-md-6">--}}
                {{--<a href="javascript:;">--}}
                    {{--<div class="card-box">--}}
                        {{--<h4 class="header-title m-t-0 m-b-30">{{trans('admin.finished_orders')}}</h4>--}}
                        {{--<div class="widget-box-2">--}}
                            {{--<div class="widget-detail-2">--}}
                                    {{--<span class="pull-left">--}}
                                        {{--<i class="zmdi zmdi-shopping-cart zmdi-hc-4x"></i>--}}
                                    {{--</span>--}}
                                {{--<h2 class="m-b-0">{{ $finishedOrder }}</h2>--}}
                                {{--<p class="text-muted m-b-15"></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--@endcan--}}
        {{--@can('offers_management')--}}
            {{--<div class="col-lg-3 col-md-6">--}}
                {{--<a href="javascript:;">--}}
                    {{--<div class="card-box">--}}
                        {{--<h4 class="header-title m-t-0 m-b-30">{{trans('admin.in_progress_orders')}}</h4>--}}
                        {{--<div class="widget-box-2">--}}
                            {{--<div class="widget-detail-2">--}}
                                    {{--<span class="pull-left">--}}
                                        {{--<i class="zmdi zmdi-shopping-cart zmdi-hc-4x"></i>--}}
                                    {{--</span>--}}
                                {{--<h2 class="m-b-0">{{ $inprogressOrder }}</h2>--}}
                                {{--<p class="text-muted m-b-15"></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--@endcan--}}
        {{--@can('package_management')--}}
            {{--<div class="col-lg-3 col-md-6">--}}
                {{--<a href="javascript:;">--}}
                    {{--<div class="card-box">--}}
                        {{--<h4 class="header-title m-t-0 m-b-30">الباقات</h4>--}}
                        {{--<div class="widget-box-2">--}}
                            {{--<div class="widget-detail-2">--}}
                                    {{--<span class="pull-left">--}}
                                        {{--<i class="zmdi zmdi-badge-check zmdi-hc-4x"></i>--}}
                                    {{--</span>--}}
                                {{--<h2 class="m-b-0">{{ \App\Models\Package::count() }}</h2>--}}
                                {{--<p class="text-muted m-b-0">إجمالي الباقات</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--@endcan--}}
        {{--@can('categories_management')--}}
            {{--<div class="col-lg-3 col-md-6">--}}
                {{--<a href="javascript:;">--}}
                    {{--<div class="card-box">--}}
                        {{--<h4 class="header-title m-t-0 m-b-30">الاقسام الرئيسية</h4>--}}
                        {{--<div class="widget-box-2">--}}
                            {{--<div class="widget-detail-2">--}}
                                    {{--<span class="pull-left">--}}
                                        {{--<i class="zmdi zmdi-desktop-mac zmdi-hc-4x"></i>--}}
                                    {{--</span>--}}
                                {{--<h2 class="m-b-0">{{ \App\Models\Category::whereParentId(0)->count() }}</h2>--}}
                                {{--<p class="text-muted m-b-0">إجمالي الاقسام الرئيسية</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}



            {{--<div class="col-lg-3 col-md-6">--}}
                {{--<a href="javascript:;">--}}
                    {{--<div class="card-box">--}}
                        {{--<h4 class="header-title m-t-0 m-b-30">الاقسام الفرعية</h4>--}}
                        {{--<div class="widget-box-2">--}}
                            {{--<div class="widget-detail-2">--}}
                                    {{--<span class="pull-left">--}}
                                        {{--<i class="zmdi zmdi-desktop-mac zmdi-hc-4x"></i>--}}
                                    {{--</span>--}}
                                {{--<h2 class="m-b-0">{{ \App\Models\Category::where('parent_id', '!=', 0)->count() }}</h2>--}}
                                {{--<p class="text-muted m-b-0">إجمالي الاقسام الفرعية</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--@endcan--}}
    </div>
@endsection
