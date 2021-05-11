@extends('front.layouts.master')
@section('title')
    {{trans('admin.contactus')}}
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
    </style>
@endsection
@section('banner')
    <!--contact-content-->
    <section class="about-content custom-padd">
        <h3 class="header2 rose">{{trans('admin.contactus')}}</h3>
        <form method="post" action="{{route('post-contact')}}"
              class="submission-form"
              enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-md-8">
                <label class="required">{{trans('admin.name')}}</label>
                <input class="form-control cart-input" type="text" required name="name" placeholder="{{trans('admin.name')}}"
                       data-parsley-trigger="keyup"
                       data-parsley-required-message="{{trans('admin.required')}}"
                       data-parsley-minlength="3"
                       data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}">
                <label class="required">{{trans('admin.phone')}}</label>
                <input class="form-control cart-input" name="mobile" type="number" required placeholder="{{trans('admin.phone')}}"
                       data-parsley-trigger="keyup"
                       data-parsley-required-message="{{trans('admin.required')}}"
                       data-parsley-type-message="{{trans('admin.required_number')}}"
                       data-parsley-maxlength="15"
                       data-parsley-maxlength-message="{{trans('admin.max',['max'=>'15','value'=>trans('admin.number')])}}"
                       data-parsley-minlength="5"
                       data-parsley-minlength-message="{{trans('admin.min',['min'=>'5','value'=>trans('admin.number')])}}">
                <label class="required">{{trans('admin.email')}}</label>
                <input class="form-control cart-input" type="email" name="email" placeholder="{{trans('admin.email')}}" required
                       data-parsley-trigger="keyup"
                       data-parsley-required-message="{{trans('admin.required')}}"
                       data-parsley-type-message="{{trans('admin.required_email')}}"
                       data-parsley-minlength="5"
                       data-parsley-minlength-message="{{trans('admin.min',['min'=>'5','value'=>trans('admin.char')])}}">
                <label class="required">{{trans('admin.title')}}</label>
                <input class="form-control cart-input" type="text" name="title" placeholder="{{trans('admin.title')}}" required
                       data-parsley-trigger="keyup"
                       data-parsley-required-message="{{trans('admin.required')}}"
                       data-parsley-minlength="3"
                       data-parsley-minlength-message="{{trans('admin.min',['min'=>'3','value'=>trans('admin.char')])}}">
                <label class="required">{{trans('admin.message')}}</label>
                <textarea class="form-control cart-input" placeholder="{{trans('admin.message')}}" name="message" required data-parsley-required-message="{{trans('admin.required')}}"></textarea>
                <button type="submit" class="btn-rose full">{{trans('admin.send')}}</button>
            </div>
        </div>
        </form>
    </section>
@endsection
