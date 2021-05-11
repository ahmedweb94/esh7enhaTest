<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\Address\AddAddressRequest;
use App\Models\Region;
use App\Repository\AddressRepository;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    protected $addressRepo;
    public function __construct(AddressRepository $addressRepo)
    {
        $this->addressRepo=$addressRepo;
    }

    public function index()
    {
        $address=$this->addressRepo->where(['status'=>1,'user_id'=>auth()->id()])->orderBy('default','desc')->get();
        $regions=Region::where('status',1)->get();
        return view('front.profile.address',compact('address','regions'));
    }

    public function store(AddAddressRequest $request)
    {
        $address=$this->addressRepo->create($request->validated());
        if($address->default==1){
        $this->addressRepo->removeOtherDefault($address->id);
        }
        return response(['status' => 200, 'message' => trans('admin.created')
            ,'html'=>view('front.profile.load-address')->render()], 200);
    }

    public function setDefault(Request $request)
    {
        $this->addressRepo->update($request->address_id,['default'=>1]);
        $this->addressRepo->removeOtherDefault($request->address_id);
        return response(['status' => 200, 'message' => trans('admin.updated')
            ,'html'=>view('front.profile.load-address')->render()], 200);
    }

    public function delete(Request $request)
    {
        $this->addressRepo->update($request->address_id,['status'=>0]);
        return response(['status' => 200, 'message' => trans('admin.deleted')], 200);
    }

}
