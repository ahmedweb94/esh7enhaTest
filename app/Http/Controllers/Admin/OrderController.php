<?php

namespace App\Http\Controllers\Admin;

use App\Helper\OrderStatus;
use App\Helper\UsersStatus;
use App\Helper\UsersType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AssignOrderRequest;
use App\Models\User;
use App\Repository\CityRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $cityRepo;
    protected $userRepo;
    public function __construct(OrderRepository $orderRepo,CityRepository $cityRepo,UserRepository $userRepo)
    {
        $this->orderRepo=$orderRepo;
        $this->cityRepo=$cityRepo;
        $this->userRepo=$userRepo;
    }

    public function index(Request $request)
    {
        $orders=$this->orderRepo->filter($request);
        $cities=$this->cityRepo->where(['status'=>1,'region_id'=>4])->select('id','name_'.session('lang'))->get();
        $users=$this->userRepo->where(['type'=>UsersType::Client])->select('id','name','mobile')->get();
        $drivers=User::where(['type'=>UsersType::Driver,'active'=>UsersStatus::Active])->get();
        return view('admin.order.index',compact('orders','cities','users','drivers'));
    }

    public function show($id)
    {
        $result=$this->orderRepo
            ->with(['address','address.city','address.city.region','user','details','details.product'])->findOrFail($id);
        return view('admin.order.show',compact('result'));
    }

    public function status($id,Request $request)
    {
        $order=$this->orderRepo->changeStatus($id,$request->all());
        return back()->with('success',trans('admin.updated'));
//        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$order->id],200);
    }

    public function assignOrderToDriver(AssignOrderRequest $request)
    {
        $order=$this->orderRepo->assignOrder($request);
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('order.index')],200);
    }

    public function getDriver($id)
    {
        $drivers=User::where(['type'=>UsersType::Driver,'active'=>UsersStatus::Active])->get();
        return view('admin.order.drivers',compact('id','drivers'));
    }

    public function orderDriver($type,$id)
    {
        if($type=='driver'){
            $orders=$this->orderRepo->where('driver_id',$id)->get();
        }elseif($type=='user'){
            $orders=$this->orderRepo->where('user_id',$id)->get();
        }
        $cities=$this->cityRepo->where(['status'=>1,'region_id'=>4])->select('id','name_'.session('lang'))->get();
        $users=$this->userRepo->where(['type'=>UsersType::Client])->select('id','name','mobile')->get();
        $drivers=User::where(['type'=>UsersType::Driver,'active'=>UsersStatus::Active])->get();
        return view('admin.order.index',compact('orders','cities','users','drivers'));
    }

}
