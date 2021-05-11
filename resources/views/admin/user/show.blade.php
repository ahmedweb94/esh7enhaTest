@extends('admin.layouts.master')
@section('title',  __('admin.user'))
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
            <h4 class="page-title">{{trans('admin.user_details')}}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <h4>{{trans('admin.user_details')}}</h4>
                        <hr>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.name')}}:</label>
                        <p>{{ $result->name }}</p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.mobile')}}:</label>
                        <p>{{ $result->mobile }}</p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.email')}}:</label>
                        <p>{{ $result->email }} </p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.orders_number')}}:</label>
                        <p>{{$result->orders_count}}</p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.addresses')}}:</label>
                        @foreach($result->addresses as $address)
                            <li>{{$address->address}}</li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

