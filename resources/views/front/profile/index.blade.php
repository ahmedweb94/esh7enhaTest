@extends('front.layouts.master')
@section('title')
    {{trans('admin.profile')}}
@endsection
@section('css')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        #confirmDiv {
            display: none;
        }
    </style>
@endsection
@section('banner')
    @include('front.profile.header')
    <div class="tab-content">
        <!--data-->
        <div class="tab-pane fade show active" id="data">
            <h4 class="header">{{trans('admin.your_profile_data')}}</h4>
            <form action="{{route('update-profile')}}" method="post" enctype="multipart/form-data"
                  class="submission-form">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label>{{trans('admin.image')}}</label>
                        <div class="profile-img"><img src="{{ url('storage/app/public/'.auth()->user()->image) }}"
                                                      alt="" id="img">
                            <div class="upload-wrap">
                                <button type="button" class="btn-upload">{{trans('admin.edit')}}</button>
                                <input type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/svg" name="image" id="upload">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>{{trans('admin.name')}} </label>
                        <input class="form-control cart-input" type="text" name="name"
                               required value="{{auth()->user()->name}}"
                               data-parsley-trigger="keyup"
                               data-parsley-required-message="{{trans('admin.required')}}"
                               data-parsley-minlength="3"
                               data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}"
                        >
                        <label>{{trans('admin.phone')}}</label>
                        <input class="form-control cart-input" type="text" name="mobile"
                               required value="{{auth()->user()->mobile}}"
                               data-parsley-trigger="keyup"
                               data-parsley-required-message="{{trans('admin.required')}}"
                               data-parsley-type-message="{{trans('admin.required_number')}}"
                               data-parsley-pattern="/(05)[0-9]{8}/"
                               data-parsley-pattern-message="{{trans('admin.number_start')}}"
                               data-limit="10"
                               data-parsley-maxlength="10"
                               data-parsley-maxlength-message="{{trans('admin.max',['max'=>'10','value'=>trans('admin.number')])}}"
                               data-parsley-minlength="5"
                               data-parsley-minlength-message="{{trans('admin.min',['min'=>'5','value'=>trans('admin.number')])}}">
                        <button class="btn-rose full">{{trans('admin.save')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </section>
@endsection
