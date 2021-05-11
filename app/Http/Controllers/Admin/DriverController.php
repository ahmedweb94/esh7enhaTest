<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriverRequest;
use App\Repository\DriverRepository;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    protected $driverRepo;
    public function __construct(DriverRepository $driverRepo)
    {
        $this->driverRepo=$driverRepo;
    }

    public function index(Request $request)
    {
        $drivers=$this->driverRepo->filter($request);
        return view('admin.driver.index',compact('drivers'));
    }

    public function create()
    {
        return view('admin.driver.create');
    }

    public function show($id)
    {
        $result=$this->driverRepo->with('user')->findOrFail($id);
        return view('admin.driver.show',compact('result'));
    }

    public function store(DriverRequest $request)
    {
        $this->driverRepo->add($request->validated());
        return response(['status'=>200,'message'=>trans('admin.created'),'url'=>route('driver.index')],200);
    }

    public function edit($id)
    {
        $driver=$this->driverRepo->with('user')->findOrFail($id);
        return view('admin.driver.create',compact('driver'));
    }

    public function update(DriverRequest $request,$id)
    {
        $this->driverRepo->edit($id,$request->validated());
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('driver.index')],200);
    }

    public function delete($id)
    {
        $this->driverRepo->delete($id);
        return response(['status'=>200,'message'=>trans('admin.deleted')],200);
    }

    public function status($id,Request $request)
    {
        $driver=$this->driverRepo->changeStatus($id,$request->all());
        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$driver->user->active],200);
    }

}
