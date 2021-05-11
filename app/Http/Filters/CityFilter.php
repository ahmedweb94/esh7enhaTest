<?php
namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Http\Filters\QueryFilter;

class CityFilter extends QueryFilter
{

    public function status($status)
    {
        if($status == 'true')
            $status = 1;
        if($status == 'false')
            $status = 0;

        $this->builder->where('is_active', $status);
    }

    public function id($id)
    {
        $this->builder->where('id', $id);
    }

    public function name($name)
    {
        $this->builder->whereHas('translations', function($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%');
            });
    }

    public function state($state)
    {
        $this->builder->where('state_id', $state);
    }

    public function zipCode($code)
    {
        $this->builder->where('zip_code', $code);
    }

    
}