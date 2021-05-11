<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use App\Http\Filters\Filterable;

class Country extends Model
{
    use Translatable, SoftDeletes, HasFactory, Filterable;

    public $translatedAttributes = ['name'];


    protected $fillable = ['code','is_active'];
    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeActive($query, $is_active)
    {
        return $query->where('is_active', $is_active);
        // if($is_active == 1){
        //     return $query->where('is_active', 1);
        // }else{
        //     return $query->where('is_active', 0);
        // }
    }

    public function states()
    {
        return $this->hasMany('App\Models\State');
    }
}
