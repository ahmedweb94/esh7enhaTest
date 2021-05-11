<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegionRequest;
use App\Models\City;
use App\Repository\RegionRepository;

class RegionController extends Controller
{
    protected $regionRepo;
    public function __construct(RegionRepository $regionRepo)
    {
        $this->regionRepo=$regionRepo;
    }

    public function index()
    {
        $regions=$this->regionRepo->getAll();
        return view('admin.region.index',compact('regions'));
    }

    public function create()
    {
        return view('admin.region.create');
    }

    public function show($id)
    {
        $result=$this->regionRepo->getById($id);
        return view('admin.region.show',compact('result'));
    }

    public function store(RegionRequest $request)
    {
        $this->regionRepo->create($request->validated());
        return response(['status'=>200,'message'=>trans('admin.created'),'url'=>route('region.index')],200);
    }

    public function edit($id)
    {
        $region=$this->regionRepo->getById($id);
        return view('admin.region.create',compact('region'));
    }

    public function update(RegionRequest $request,$id)
    {
        $this->regionRepo->update($id,$request->validated());
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('region.index')],200);
    }

    public function delete($id)
    {
        $this->regionRepo->delete($id);
        return response(['status'=>200,'message'=>trans('admin.deleted')],200);
    }

    public function status($id)
    {
        $region=$this->regionRepo->changeStatus($id);
        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$region->status],200);
    }

    public function cityByRegion($id)
    {
        $city=City::where(['region_id'=>$id,'status'=>1])->get();
        return $city;
    }

}
