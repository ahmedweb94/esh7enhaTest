<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Filters\Filterable;

class State extends Model
{
    use Translatable, HasFactory, SoftDeletes, Filterable;
    public $translatedAttributes = ['name'];
    protected $fillable = ['country_id', 'is_active'];
    // protected $guarded = [
    //     "id",
    // ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
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

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }
}
