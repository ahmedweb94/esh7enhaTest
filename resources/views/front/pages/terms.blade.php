@extends('front.layouts.master')
@section('title')
    {{trans('admin.terms')}}
@endsection
@section('banner')
    <!--condition-content-->
    <section class="about-content custom-padd">
        <h3 class="header2 rose">{{trans('admin.terms')}}</h3>
       {!! $item->{'value_'.session('lang')} !!}
        {{--<div class="pretty p-default">--}}
            {{--<input type="checkbox">--}}
            {{--<div class="state">--}}
                {{--<label>Agree to terms and conditions</label>--}}
            {{--</div>--}}
        {{--</div>--}}
    </section>
@endsection
