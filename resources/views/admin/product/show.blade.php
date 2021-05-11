@extends('admin.layouts.master')
@section('title',  __('admin.product'))
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="btn-group pull-right m-t-15">
                <button type="button" class="btn btn-custom  waves-effect waves-light"
                        onclick="window.history.back();return false;"> @lang('maincp.back') <span class="m-l-5"><i
                            class="fa fa-reply"></i></span>
                </button>
            </div>
            <h4 class="page-title">{{trans('admin.product_details')}}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <h4>{{trans('admin.product_details')}}</h4>
                        <hr>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.name_en')}}:</label>
                        <p>{{ $result->name_en }}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.name_ar')}}:</label>
                        <p>{{ $result->name_ar }}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.category')}}:</label>
                        <p>{{ $result->category->{'name_'.session('lang')} }}</p>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.price')}}:</label>
                        <p>{{ $result->price }}  {{trans('admin.sar')}}</p>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.description_en')}}:</label>
                        <p>{!!  $result->description_en !!}</p>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.description_ar')}}:</label>
                        <p>{!!  $result->description_ar !!}</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
                            <label>{{trans('admin.image')}}:</label>
                            <img width="100%" style="height: auto; border-radius: 10px; margin-bottom: 10px"
                                 src="{{ url('storage/app/public/'.$result->image) }}">
                        </div>
                        <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
                            <label>@lang('admin.date') :</label>
                            <p>{{date('H:i:s || Y/m/d', strtotime($result->created_at))  }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

