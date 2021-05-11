<?php

namespace App\Repository;

use App\Helper\UploadImages;
use App\Models\Region;

class RegionRepository extends Repository
{
    protected $model;

    public function __construct(Region $model)
    {
        $this->model = $model;
    }

    public function changeStatus($id)
    {
        $cat=$this->getById($id);
        $data['status']=$cat->status==1?0:1;
        return $this->update($id,$data);
    }

}
