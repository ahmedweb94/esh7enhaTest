<?php

namespace App\Repository;

use App\Models\Page;

class PageRepository extends Repository
{
    protected $model;
    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}
