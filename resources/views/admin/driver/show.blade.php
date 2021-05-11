@extends('admin.layouts.master')
@section('title',  __('admin.driver'))
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
            <h4 class="page-title">{{trans('admin.driver_details')}}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <h4>{{trans('admin.driver_details')}}</h4>
                        <hr>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.name')}}:</label>
                        <p>{{ $result->user->name }}</p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.mobile')}}:</label>
                        <p>{{ $result->user->mobile }}</p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.identity')}}:</label>
                        <p>{{ $result->identity }} </p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.vehicle_type')}}:</label>
                        <p>{!!  $result->vehicle_type !!}</p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.vehicle_number')}}:</label>
                        <p>{!!  $result->vehicle_number !!}</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
                            <label>{{trans('admin.identity_image')}}:</label>
                            <img width="100%" style="height: auto; border-radius: 10px; margin-bottom: 10px"
                                 src="{{ url('storage/app/public/'.$result->identity_image) }}">
                        </div>
                        <div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
                            <label>{{trans('admin.vehicle_image')}}:</label>
                            <img width="100%" style="height: auto; border-radius: 10px; margin-bottom: 10px"
                                 src="{{ url('storage/app/public/'.$result->vehicle_image) }}">
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

