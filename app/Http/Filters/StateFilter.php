<?php
namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Http\Filters\QueryFilter;

class StateFilter extends QueryFilter
{

    public function status($status)
    {
        if($status == 'true')
            $status = 1;
        if($status == 'false')
            $status = 0;

        $this->builder->where('is_active', $status);
    }

    public function name($name)
    {
        $this->builder->whereHas('translations', function($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%');
            });
    }

    public function country($country)
    {
        $this->builder->where('country_id', $country);
    }

    
}