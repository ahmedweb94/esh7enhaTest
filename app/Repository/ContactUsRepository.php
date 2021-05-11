<?php

namespace App\Repository;

use App\Models\ContactUs;

class ContactUsRepository extends Repository
{
    protected $model;

    public function __construct(ContactUs $model)
    {
        $this->model = $model;
    }

}
