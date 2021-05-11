<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 4/20/2021
 * Time: 5:02 PM
 */

namespace App\Helper;


use App\Models\Cart;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\Cookie;

class CartCount
{
    public static function count()
    {
        if(auth()->check()){
            $count=auth()->user()->cart->count();
        }else{
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $count = count(collect(json_decode($cookie_data, true))->toArray());
        }
        return $count;
    }

    public static function total()
    {
        $total=0;
        if (auth()->check()){
            $cart=Cart::with('product')->where('user_id',auth()->id())->get();
            foreach ($cart as $item){
                $total+=$item->product->price*$item->qty;
            }
        }else{
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart = collect(json_decode($cookie_data, true));
            foreach($cart as $item){
                $total+=$item['price']*$item['qty'];
            }
        }
        return $total;
    }

    public static function delivery()
    {
        return Setting::where('index','delivery_fees')->first()->amount;
    }

    public static function addCookieToCart()
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart = collect(json_decode($cookie_data, true));
        $arr=[];
        foreach ($cart as $item)
        {
            if(!Product::where(['id'=>$item['product_id'],'status'=>1,'empty'=>0])->first()) continue;
            if($cart=auth()->user()->cart->where('product_id',$item['product_id'])->first()){
                $cart->qty=$cart->qty +$item['qty'];
                $cart->save();
                continue;
            }
            $data['product_id']=$item['product_id'];
            $data['user_id']=auth()->id();
            $data['qty']=$item['qty'];
            $data['created_at']=now();
            $data['updated_at']=now();
            array_push($arr,$data);
        }
        if(Cart::insert($arr)){
            Cookie::queue(Cookie::forget('shopping_cart'));
        }
    }


}
