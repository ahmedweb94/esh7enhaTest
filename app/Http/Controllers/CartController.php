<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\Cart\AddToCartRequest;
use App\Http\Requests\Front\Cart\RemoveFromCartRequest;
use App\Http\Requests\Front\Cart\UpdateCartRequest;
use App\Models\Product;
use App\Repository\CartRepository;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

    protected $cartRepo;
    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepo=$cartRepo;
    }

    public function index()
    {
        if(auth()->check()){
        $cart=$this->cartRepo->with('product')->where(['user_id'=>auth()->id()])->get();
            $this->cartRepo->removeEmptyProduct($cart);
        }else{
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart = collect(json_decode($cookie_data, true));
        }
        return view('front.cart.cart',compact('cart'));
    }

    public function addToCart(AddToCartRequest $request)
    {
        if($product=Product::where(['id'=>$request['product_id'],'status'=>1,'empty'=>0])->first()){
            $count=$this->cartRepo->addToCart($request->validated());
            return response(['status' => 200, 'message' => trans('admin.item_added_to_cart'),'count'=>$count], 200);
        }else{
            return response(['status' => 400, 'message' => trans('admin.item_not_available')], 200);
        }
    }

    public function updateCart(UpdateCartRequest $request)
    {
        $cart=$this->cartRepo->updateCart($request);
        return response(['status' => 200, 'message' => trans('admin.updated'),
            'count'=>$cart->count(),'info'=>view('front.cart.cartInfo',compact('cart'))->render()], 200);
    }

    public function remove(RemoveFromCartRequest $request)
    {
        $cart=$this->cartRepo->removeFromCart($request->cart_id);
        return response(['status' => 200, 'message' => trans('admin.item_deleted_from_cart'),
            'count'=>$cart->count(),'info'=>view('front.cart.cartInfo',compact('cart'))->render()], 200);
    }
}
