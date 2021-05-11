<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Repository\CityRepository;
use App\Repository\RegionRepository;

class CityController extends Controller
{
    protected $cityRepo;
    protected $regionRepo;
    public function __construct(CityRepository $cityRepo,RegionRepository $regionRepo)
    {
        $this->cityRepo=$cityRepo;
        $this->regionRepo=$regionRepo;
    }

    public function index()
    {
        $cities=$this->cityRepo->with('region')->get();
        return view('admin.city.index',compact('cities'));
    }

    public function create()
    {
        $regions=$this->regionRepo->getAll();
        return view('admin.city.create',compact('regions'));
    }

    public function show($id)
    {
        $result=$this->cityRepo->getById($id);
        return view('admin.city.show',compact('result'));
    }

    public function store(CityRequest $request)
    {
        $this->cityRepo->create($request->validated());
        return response(['status'=>200,'message'=>trans('admin.created'),'url'=>route('city.index')],200);
    }

    public function edit($id)
    {
        $city=$this->cityRepo->getById($id);
        $regions=$this->regionRepo->getAll();
        return view('admin.city.create',compact('city','regions'));
    }

    public function update(CityRequest $request,$id)
    {
        $this->cityRepo->update($id,$request->validated());
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('city.index')],200);
    }

    public function delete($id)
    {
        $city=$this->cityRepo->checkDelete($id);
        if($city) {
            return response(['status' => 200, 'message' => trans('admin.deleted')], 200);
        }else{
            return response(['status' => 400, 'message' => trans('admin.this_city_has_address')], 200);
        }
    }

    public function status($id)
    {
        $city=$this->cityRepo->changeStatus($id);
        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$city->status],200);
    }

}
