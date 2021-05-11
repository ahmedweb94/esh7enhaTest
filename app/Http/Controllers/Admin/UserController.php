<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UsersType;
use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo=$userRepo;
    }

    public function index(Request $request)
    {
        $users=$this->userRepo->filter($request);
        return view('admin.user.index',compact('users'));
    }

    public function show($id)
    {
        $result=$this->userRepo->withCount('orders')->with('addresses')->where('type',UsersType::Client)->findOrFail($id);
        return view('admin.user.show',compact('result'));
    }

    public function status($id,Request $request)
    {
        $user=$this->userRepo->changeStatus($id,$request->all());
        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$user->active],200);
    }

}
