<button class="close" data-dismiss="modal"><span>&times;</span></button>
<div class="modal-img-wrap"><img src="{{ url('storage/app/public/'.$product->image) }}"></div>
<h3 class="header2">{{$product->{'name_'.session('lang')} }}</h3>
<div class="modal-btns">
    <button class="btn-rose"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/dollar.svg" alt=""><span>{{$product->price}}</span><span class="small">{{trans('admin.sar')}}</span></button>
    {{--<button class="btn-icon purble"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/share.svg" alt=""></button>--}}
    <button data-product="{{$product->id}}" class="btn-icon rose btn-like {{(auth()->check() && in_array($product->id,auth()->user()->liked->pluck('product_id')->toArray()))?'liked':''}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/{{(auth()->check() && in_array($product->id,auth()->user()->liked->pluck('product_id')->toArray()))?'liked.svg':'like.svg'}}" alt=""></button>
</div>
<p>{!! $product->{'description_'.session('lang')} !!}</p>
<div class="modal-btns">
    <div class="input-group incr border-btn">
        <input class="txt-value" type="number" name="qty" readonly value="1">
        <button class="minus"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/angle-down.svg" alt=""></button>
        <button class="plus"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/angle-up.svg" alt=""></button>
    </div>
    <button class="btn-rose {{$product->empty==1?'disabled':'add-to-cart'}}" data-checkout="1" data-product="{{$product->id}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/cart.svg" alt=""><span>{{trans('admin.add_to_cart_and_checkout')}}</span></button>
    <button class="btn-border rose {{$product->empty==1?'disabled':'add-to-cart'}}" data-product="{{$product->id}}"><img src="{{asset('public/assets/front/')}}/assets/imgs/section/cart.svg" alt=""><span>{{trans('admin.add_to_cart_and_complete_shopping')}}</span></button>
</div>

<script>
    $('.btn-like').on('click',function(){
        var button=$(this);
        var product_id=$(this).attr('data-product');
        $.ajax({
            type: 'POST',
            url: '{{ route('liked') }}',
            data: {product_id: product_id},
            success: function (data) {
                if(data.status==200){
                    if (data.liked==false) {
                        $('#profileLike'+product_id).remove();
                        $(button).find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/like.svg');
                        $(button).removeClass('liked');

                        $('#proModal'+product_id).find('.btn-like').find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/like.svg');
                        $('#proModal'+product_id).find('.btn-like').removeClass('liked');
                    }
                    else {
                        $(button).find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/liked.svg');
                        $(button).addClass('liked');

                        $('#proModal'+product_id).find('.btn-like').find('img').attr('src', '{{asset('public/assets/front/')}}/assets/imgs/home/liked.svg');
                        $('#proModal'+product_id).find('.btn-like').addClass('liked');
                    }
                }
                if(data.status==400){
                    if(data.message){
                        swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});
                    }
                }
            }
        });
    });

    $('.add-to-cart').on('click',function (e) {
        e.preventDefault();
        var product_id=$(this).attr('data-product');
        var redirect=$(this).attr('data-checkout');
        var qty=$(this).closest('.modal-btns').find('.txt-value').val();
        $.ajax({
            type: 'POST',
            url: '{{ route('add-to-cart') }}',
            data: {product_id: product_id,qty:qty},
            success: function (data) {
                if(data.status==200){
                    $('#cart-count').html(data.count);
                    $('#cart-count2').html(data.count);
                    swal("", data.message, "success", {button: '{{trans('admin.ok')}}'});
                    $('.modal').modal('hide');
                    if(redirect){
                        setTimeout(function () {
                            window.location.href = '{{route('cart')}}';
                        }, 1000);
                    }
                }
                if(data.status==400){
                    swal("", data.message, "error", {button: '{{trans('admin.ok')}}'});
                }
            },
            error: function (response) {
                errors = response.responseJSON.errors;
                swal("", errors[Object.keys(errors)[0]][0], "error", {button: '{{trans('admin.ok')}}'});
            }
        })

    });

    $('.incr .plus').on('click', function () {
        var input = $(this).parent().find('input');
        var exVal = parseInt(input.val());
        var val = exVal + 1;
        input.val(val);
    });
    $('.incr .minus').on('click', function () {
        var input = $(this).parent().find('input');
        var exVal = parseInt(input.val());
        if (exVal > 1) {
            var val = exVal - 1;
            input.val(val);
        }
    });
</script>
