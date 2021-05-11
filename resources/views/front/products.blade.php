@extends('front.layouts.master')
@section('title')
    {{trans('admin.products')}}
@endsection
@section('banner')
    <!--section-content-->
    <section class="section-content custom-padd">
        <h3 class="header2 rose">{{trans('admin.products')}}</h3>
        <div class="mr-b-30">
            @if($products->count()>0)
            <div class="row">
                @foreach($products as $item)
                <div class="col-md-6 {{$loop->iteration% 2==0?'mr-t-30':''}}">
                    <div class="f-product" data-toggle="modal" data-target="#proModal{{$item->id}}">
                        <div class="pro-img-wrap">
                                <img src="{{ url('storage/app/public/'.$item->image) }}">
                            <button data-product="{{$item->id}}" class="btn-icon rose btn-like {{(auth()->check() && in_array($item->id,auth()->user()->liked->pluck('product_id')->toArray()))?'liked':''}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/{{(auth()->check() && in_array($item->id,auth()->user()->liked->pluck('product_id')->toArray()))?'liked.svg':'like.svg'}}" alt=""></button>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-8 col-lg-6">
                                <h4>{{$item->{'name_'.session('lang')} }}</h4>
                                <div class="price"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg" alt=""><span class="rose">{{$item->price}}</span><span>{{trans('admin.sar')}}</span></div>
                            </div>
                                <div class="col-6 col-md-4 col-lg-6 text-right">
                                    @if($item->empty==1)
                                        <span class="rose">{{trans('admin.out_of_stock')}}</span>
                                    @endif
                                    <button class="btn-icon green {{$item->empty==1?'disabled':''}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt=""></button>
                                </div>
                        </div>
                    </div>
                </div>
                    <!--modal-->
                    <div class="modal fade" id="proModal{{$item->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                                <div class="modal-img-wrap"><img src="{{ url('storage/app/public/'.$item->image) }}"></div>
                                <h3 class="header2">{{$item->{'name_'.session('lang')} }}</h3>
                                <div class="modal-btns">
                                    <button class="btn-rose"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/dollar.svg" alt=""><span>{{$item->price}}</span><span class="small">{{trans('admin.sar')}}</span></button>
                                    {{--<button class="btn-icon purble"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/share.svg" alt=""></button>--}}
                                    <button data-product="{{$item->id}}" class="btn-icon rose btn-like {{(auth()->check() && in_array($item->id,auth()->user()->liked->pluck('product_id')->toArray()))?'liked':''}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/{{(auth()->check() && in_array($item->id,auth()->user()->liked->pluck('product_id')->toArray()))?'liked.svg':'like.svg'}}" alt=""></button>
                                </div>
                                <p>{!! $item->{'description_'.session('lang')} !!}</p>
                                <div class="modal-btns">
                                    <div class="input-group incr border-btn">
                                        <input class="txt-value" type="number" name="qty" readonly value="1">
                                        <button class="minus"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/angle-down.svg" alt=""></button>
                                        <button class="plus"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/angle-up.svg" alt=""></button>
                                    </div>
                                    <button class="btn-rose {{$item->empty==1?'disabled':'add-to-cart'}}" data-checkout="1" data-product="{{$item->id}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/cart.svg" alt=""><span>{{trans('admin.add_to_cart_and_checkout')}}</span></button>
                                    <button class="btn-border rose {{$item->empty==1?'disabled':'add-to-cart'}}" data-product="{{$item->id}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/cart.svg" alt=""><span>{{trans('admin.add_to_cart_and_complete_shopping')}}</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--section-content-->
                @endforeach
            </div>
            @else
                <h4 class="text-center">{{trans('admin.no_product_found')}}</h4>
            @endif
            <div class="text-center">{{ $products->appends($_GET)->links()  }}</div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        {{--$('.btn-like').on('click',function(){--}}
           {{--var button=$(this);--}}
           {{--var product_id=$(this).attr('data-product');--}}
            {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: '{{ route('liked') }}',--}}
                {{--data: {product_id: product_id},--}}
                {{--success: function (data) {--}}
                    {{--if(data.status==200){--}}
                    {{--if (data.liked==false) {--}}
                        {{--$(button).find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/like.svg');--}}
                        {{--$(button).removeClass('liked');--}}
                        {{--$('#proModal'+product_id).find('.btn-like').find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/like.svg');--}}
                        {{--$('#proModal'+product_id).find('.btn-like').removeClass('liked');--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--$(button).find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/liked.svg');--}}
                        {{--$(button).addClass('liked');--}}

                        {{--$('#proModal'+product_id).find('.btn-like').find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/liked.svg');--}}
                        {{--$('#proModal'+product_id).find('.btn-like').addClass('liked');--}}
                    {{--}--}}
                    {{--}--}}
                    {{--if(data.status==400){--}}
                        {{--if(data.message){--}}
                            {{--swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});--}}
                        {{--}--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
        {{--$('.add-to-cart').on('click',function (e) {--}}
            {{--e.preventDefault();--}}
            {{--var product_id=$(this).attr('data-product');--}}
            {{--var redirect=$(this).attr('data-checkout');--}}
            {{--var qty=$(this).closest('.modal-btns').find('.txt-value').val();--}}
            {{--console.log(redirect);--}}
            {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: '{{ route('add-to-cart') }}',--}}
                {{--data: {product_id: product_id,qty:qty},--}}
                {{--success: function (data) {--}}
                    {{--if(data.status==200){--}}
                        {{--$('#cart-count').html(data.count);--}}
                        {{--$('#cart-count2').html(data.count);--}}
                        {{--swal("", data.message, "success", {button: '{{trans('admin.ok')}}'});--}}
                        {{--if(redirect){--}}
                            {{--setTimeout(function () {--}}
                                {{--window.location.href = '{{route('checkout')}}';--}}
                            {{--}, 1000);--}}
                        {{--}--}}
                    {{--}--}}
                    {{--if(data.status==400){--}}
                        {{--swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});--}}
                    {{--}--}}
                {{--},--}}
                {{--error: function (response) {--}}
                    {{--errors = response.responseJSON.errors;--}}
                    {{--swal("", errors[Object.keys(errors)[0]][0], "error", {button: '{{trans('admin.ok')}}'});--}}
                {{--}--}}
            {{--})--}}

        {{--});--}}
        //increament btn
        // $('.incr .plus').on('click', function () {
        //     var input = $(this).parent().find('input');
        //     var exVal = parseInt(input.val());
        //     var val = exVal + 1;
        //     input.val(val);
        // });
        // $('.incr .minus').on('click', function () {
        //     var input = $(this).parent().find('input');
        //     var exVal = parseInt(input.val());
        //     if (exVal > 1) {
        //         var val = exVal - 1;
        //         input.val(val);
        //     }
        // });
    </script>
    @endsection
