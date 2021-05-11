<?php

namespace App\Repository;

use App\Models\Admin;

class AdminRepository extends Repository
{
    protected $model;
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }
}
