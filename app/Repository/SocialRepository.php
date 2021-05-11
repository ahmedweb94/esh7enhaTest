<?php

namespace App\Repository;

use App\Models\Social;

class SocialRepository extends Repository
{
    protected $model;

    public function __construct(Social $model)
    {
        $this->model = $model;
    }
}
