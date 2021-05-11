<div class="cart-info">
    <h4 class="green">{{trans('admin.cart_info')}}</h4>
    <div class="row">
        <div class="col-6">
            <h5>{{trans('admin.products')}}</h5>
        </div>
        <?php
        $total=0;
        if(auth()->check()){
            foreach ($cart as $item){
              $total+=$item->product->price* $item->qty;
            }
        }else{
            foreach ($cart as $item){
                $total+=$item['price']* $item['qty'];
            }
        }
        ?>
        <div class="col-6 text-right"><span class="rose">{{number_format($total,2)}}</span></div>
    </div>
    <div class="row">
        <div class="col-6">
            <h5>{{trans('admin.delivery')}}</h5>
        </div>
        <div class="col-6 text-right">
            <span class="rose">{{number_format($delivery,2)}}</span></div>
    </div>
    <div class="row">
        <div class="col-6">
            <h5>{{trans('admin.total')}}</h5>
        </div>
        <div class="col-6 text-right">
            <span class="rose">{{number_format($total + $delivery,2)}}</span>
        </div>
    </div>
    <button id="finish-order" onclick="checkoutBtn()" class="btn-rose full"><img src="{{asset('public/assets/front/')}}/assets/imgs/home/cart.svg" alt="">
        <span>
       @if(\Illuminate\Support\Facades\URL::current()==route('cart'))
        {{trans('admin.complete_order')}}
           @elseif(\Illuminate\Support\Facades\URL::current()==route('checkout'))
            {{trans('admin.finish_order')}}
        @endif
        </span>
    </button>
</div>
