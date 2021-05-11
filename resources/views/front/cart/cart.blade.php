@extends('front.layouts.master')
@section('title')
    {{trans('admin.cart')}}
@endsection
@section('css')
    <style>
        .incr .plus2 {
            top: 4px; }
        .incr .minus2{
            bottom: 4px; }
    </style>
    @endsection
@section('banner')
    <!--cart-content-->
    <section class="cart custom-padd">
        <h3 class="header2 rose">{{trans('admin.cart')}}</h3>
        @if($cart->count()>0)
            @foreach($cart as $item)
                <div class="cart-item box-shad" id="cartId{{auth()->check()?$item->id:$item['product_id']}}">
                    <div class="row">
                        <div class="col-3 my-auto">
                            <div class="cart-img"><img
                                    src="{{url('storage/app/public/').'/'.(auth()->check()?$item->product->image:$item['image'])}}">
                            </div>
                        </div>
                        <div class="col-4 my-auto">
                            <h5>
                                @auth{{$item->product->{'name_'.session('lang')} }}@else {!!$item['name_'.session('lang')]!!}
                                @endauth</h5>
                            <div class="price">
                                <img src="{{asset('public/assets/front/')}}/assets/imgs/home/dollar.svg" alt="">
                                <span
                                    class="rose">@auth{{$item->product->price }}@else {{$item['price']}}@endauth</span>
                                <span>{{trans('admin.sar')}}</span>
                            </div>
                        </div>
                        <div class="col-5 my-auto text-right">
                            <div class="input-group incr border-btn">
                                <input class="txt-value" type="number" value="{{$item['qty']}}" name="qty" readonly>
                                <button class="minus2 change-qty"  data-id="@auth{{$item->id}}@else{{$item['product_id']}}@endauth"><img
                                        src="{{asset('public/assets/front/')}}/assets/imgs/section/angle-down.svg"
                                        alt=""></button>
                                <button class="plus2 change-qty"  data-id="@auth{{$item->id}}@else{{$item['product_id']}}@endauth"><img
                                        src="{{asset('public/assets/front/')}}/assets/imgs/section/angle-up.svg" alt="">
                                </button>
                            </div>
                            <button class="btn-icon rose removeItem"
                                    data-id="@auth{{$item->id}}@else{{$item['product_id']}}@endauth">
                                <img src="{{asset('public/assets/front/')}}/assets/imgs/section/trash.svg" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3 class="text-center">{{trans('admin.cart_empty')}}</h3>
    @endif
    <!--only mob-->
        <div class="only-xs" id="cart-info-div-xs">
            @if($cart->count()>0)
                @include('front.cart.cartInfo')
            @endif
        </div>
    </section>
@endsection
@section('side')
    <!--cart-info-->
    <div class="cart-det custom-padd">
        <div class="col-lg-8" id="cart-info-div">
            @if($cart->count()>0)
                @include('front.cart.cartInfo')
            @endif
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.removeItem').on('click', function (e) {
            e.preventDefault();
            cart_id = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '{{ route('remove-from-cart') }}',
                data: {cart_id: cart_id},
                success: function (data) {
                    if (data.status == 200) {
                        $('#cartId' + cart_id).remove();
                        $('#cart-count2').html(data.count);
                        $('#cart-count').html(data.count);
                        $('#cart-info-div').empty();
                        $('#cart-info-div').html(data.info);
                        $('#cart-info-div-xs').empty();
                        $('#cart-info-div-xs').html(data.info);
                    }
                    if (data.status == 400) {
                        swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});
                    }
                },
                error: function (response) {
                    errors = response.responseJSON.errors;
                    swal("", errors[Object.keys(errors)[0]][0], "error", {button: '{{trans('admin.ok')}}'});
                }
            })
        });

        $('.change-qty').on('click',function (e) {
            e.preventDefault();
            var cart_id = $(this).attr('data-id');
            var input = $(this).parent().find('input');
            var exVal=parseInt(input.val());
            if($(this).hasClass('plus2')){
            var qty = exVal + 1;
            input.val(qty);
            }
            if($(this).hasClass('minus2')){
                if(exVal > 1){
                    var qty = exVal - 1;
                    input.val(qty);
                }
            }
            if(qty){
            $.ajax({
                type: 'POST',
                url: '{{ route('update-cart') }}',
                data: {cart_id: cart_id,qty:qty},
                success: function (data) {
                    if (data.status == 200) {
                        $('#cart-info-div').empty();
                        $('#cart-info-div').html(data.info);
                        $('#cart-info-div-xs').empty();
                        $('#cart-info-div-xs').html(data.info);
                    }
                    if (data.status == 400) {
                        input.val(exVal);
                        swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});
                    }
                },
                error: function (response) {
                    input.val(exVal);
                    errors = response.responseJSON.errors;
                    swal("", errors[Object.keys(errors)[0]][0], "error", {button: '{{trans('admin.ok')}}'});
                }
            });
            }
        });
    </script>
@endsection
