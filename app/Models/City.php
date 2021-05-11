<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Filters\Filterable;

class City extends Model
{
    use Translatable, HasFactory, SoftDeletes, Filterable;
    public $translatedAttributes = ['name'];
    protected $guarded = ['id'];
    protected $table = 'cities';
    protected $casts = [
        'is_main' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function scopeActive($query, $is_active)
    {
        return $query->where('is_active', $is_active);
        // if($is_active == 1){
        //     return $query->where('is_active', 1);
        // }else{
        //     return $query->where('is_active', 0);
        // }
    }
}
