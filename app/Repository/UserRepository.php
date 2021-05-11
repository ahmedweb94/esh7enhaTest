<?php

namespace App\Repository;

use App\Helper\Messages;
use App\Helper\RandomCode;
use App\Helper\SMS;
use App\Helper\UploadImages;
use App\Helper\UsersStatus;
use App\Helper\UsersType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function register($data)
    {
        DB::beginTransaction();
        $data['verifiy_code'] = $this->quickRandom();
        $data['active'] = UsersStatus::Active;
        $data['lang'] = session('lang')??'ar';
        $user = $this->create($data);
//        $user->devices()->create(['device_id' => $data['device_id']]);
        DB::commit();
        return $user;
    }

    public function quickRandom($length = 4)
    {
        $pool = '0123456789';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    public function checkPassword($user, $data)
    {
        if (Hash::check($data['old_password'], $user->password)) {
            $user->update(['password' => bcrypt($data['password'])]);
            return true;
        } else {
            return false;
        }
    }

    public function changeStatus($id,$request)
    {
        $driver = $this->getById($id);
        $driver->active = $driver->active == 1 ? 0 : 1;
        $driver->reason=isset($request['reason'])?$request['reason']:null;
        $driver->save();
        return $driver;
    }

    public function updateProfile($request)
    {
        $data['name']=$request['name'];
        if(isset($request['image'])){
            $data['image']=UploadImages::upload($request['image'],'User',
                auth()->user()->image=='logo.png'?'':auth()->user()->image);
        }
        if(isset($request['mobile']) && $request['mobile']!=auth()->user()->mobile){
            $data['tmp_mobile']=$request['mobile'];
            $data['verifiy_code']=$this->quickRandom();
        }
        $this->update(auth()->id(),$data);
        //TODO Send SMS To New User Mobile (tmp_mobile)
        SMS::send(auth()->user()->tmp_mobile,Messages::Code.auth()->user()->verifiy_code);

    }

    public function filter($data)
    {
        $drivers = $this->withCount('orders')->where('type',UsersType::Client);
        if ($data['mobile']) {
            $mobile = $data['mobile'];
            $drivers = $drivers->where('mobile', 'LIKE', "%$mobile%");
        }
        if ($data['name']) {
            $name = $data['name'];
            $drivers = $drivers->where('mobile', 'LIKE', "%$name%");
        }
        if (isset($data['status'])) {
            $drivers = $drivers->where('active', $data['status']);
        } else {
            $drivers = $drivers->where('active', 1);
        }
        return $driver = $drivers->get();
    }
}
