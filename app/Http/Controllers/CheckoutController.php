<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\Cart\CheckoutRequest;
use App\Http\Requests\Front\RejectOrderRequest;
use App\Models\Address;
use App\Models\Region;
use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{

    protected $cartRepo;
    protected $orderRepo;

    public function __construct(CartRepository $cartRepo,OrderRepository $orderRepo)
    {
        $this->cartRepo = $cartRepo;
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        $cart = $this->cartRepo->with('product')->where(['user_id' => auth()->id()])->get();
        $this->cartRepo->removeEmptyProduct($cart);
        if($cart->count()>0){
        $address=Address::where(['user_id'=>auth()->id(),'status'=>1])->orderBy('default','desc')->get();
        $regions=Region::where('status',1)->get();
        return view('front.checkout.index', compact('cart','address','regions'));
        }else{
            return back()->withErrors(trans('admin.cart_empty'));
        }
    }

    public function checkout(CheckoutRequest $request)
    {
       if($request->payment_type=='credit'){
           //TODO Online Payment
           return response(['status' => 200,'payment'=>'online'], 200);
       }else{
           DB::beginTransaction();
           $order=$this->orderRepo->createOrder($request->validated());
           DB::commit();
           return response(['status' => 200, 'message' => trans('admin.order_created',['number'=>$order->id])
               ,'url'=>route('home')], 200);
       }
    }

    public function track()
    {
        $orders=$this->orderRepo->with('address','details','details.product','user')->where('user_id',auth()->id())->get();
        return view('front.profile.track',compact('orders'));
    }

    public function orderDetails($id)
    {
        $order=$this->orderRepo->with('address','details','details.product','user')->findOrFail($id);
        return view('front.driverOrder',compact('order'));
    }

    public function finishOrder($id)
    {
        $this->orderRepo->finishOrder($id);
        return redirect(route('home'))->with('success',trans('admin.delivered'));
    }

    public function rejectDeliver(RejectOrderRequest $request)
    {
        $this->orderRepo->rejectDeliver($request->validated());
        return redirect(route('home'))->with('success',trans('admin.done'));
    }
}
