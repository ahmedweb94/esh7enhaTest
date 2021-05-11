<?php

namespace App\Repository;

use App\Models\City;

class CityRepository extends Repository
{
    protected $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function changeStatus($id)
    {
        $cat=$this->getById($id);
        $data['status']=$cat->status==1?0:1;
        return $this->update($id,$data);
    }

    public function checkDelete($id)
    {
        $city=$this->withCount('addresses')->findOrFail($id);
        if($city->addresses_count==0){
            return $this->delete($id);
        }else{
            return false;
        }
    }
}
