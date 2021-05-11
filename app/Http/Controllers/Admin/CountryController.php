<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Http\Requests\Location\CountryFormRequest;
use App\Models\Country;
use App\Models\CountryTranslation;
use App\Repository\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CountryController extends Controller
{
    protected $countryRepo;
    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepo=$countryRepo;
    }

    public function index()
    {
        $countries=$this->countryRepo->getAll();
        return view('admin.country.index',compact('countries'));
    }

    public function create()
    {
        return view('admin.country.create');
    }

    public function show($id)
    {
        $result=$this->countryRepo->getById($id);
        return view('admin.country.show',compact('result'));
    }

    public function store(CountryFormRequest $request)
    {
//        dd($request->validated());
        $country=Country::create($request->all());
//        CountryTranslation::create(['name'=>$request->en['name'],'locale'=>'en','country_id'=>$country->id]);
        return response(['status'=>200,'message'=>trans('admin.created'),'url'=>route('country.index')],200);
    }

    public function edit($id)
    {
        $country=$this->countryRepo->getById($id);
        return view('admin.country.create',compact('country'));
    }

    public function update(CountryFormRequest $request,$id)
    {
        $this->countryRepo->update($id,$request->validated());
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('country.index')],200);
    }

    public function delete($id)
    {
        $country=$this->countryRepo->checkDelete($id);
        if($country) {
            return response(['status' => 200, 'message' => trans('admin.deleted')], 200);
        }else{
            return response(['status' => 400, 'message' => trans('admin.this_country_has_address')], 200);
        }
    }

    public function status($id)
    {
        $country=$this->countryRepo->changeStatus($id);
        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$country->status],200);
    }

}
