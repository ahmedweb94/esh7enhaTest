@extends('admin.layouts.master')
@section('title', __('admin.contactus'))
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
            <h4 class="page-title">{{trans('admin.contactus')}}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="card-box">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <h4>{{trans('admin.contactus')}}</h4>
                        <hr>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.name')}}:</label>
                        <p>{{ $contact->name }}</p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.mobile')}}:</label>
                        <p>{{ $contact->mobile }}</p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.email')}}:</label>
                        <p>{{ $contact->email }} </p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.title')}}:</label>
                        <p>{!!  $contact->title !!}</p>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.date')}}:</label>
                        <p>{!!  $contact->created_at->toDateString() !!}</p>
                    </div>
                    <div class="col-lg-12 col-xs-12 col-md-6 col-sm-6">
                        <label>{{trans('admin.message')}}:</label>
                        <p>{!!  $contact->message !!}</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-6 col-sm-6">
                            <label>{{trans('admin.reply')}}:</label>
                            @if($contact->reply)
                                <p>{!! $contact->reply !!}</p>
                        </div>
                            @else

                                <form method="post" class="submission-form" data-parsley-validate novalidate action="{{route('replay',$contact->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-12 col-xs-12 col-md-6 col-sm-6">
                                <textarea required class="form-control"
                                          name="reply"
                                          placeholder="{{trans('admin.reply')}}"
                                          data-parsley-trigger="keyup"
                                          data-parsley-required-message="{{trans('admin.required')}}"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-primary">{{trans('admin.send')}}</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
@endsection





