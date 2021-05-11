<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    use HasFactory;

//    protected $guarded = [];
    protected $fillable = ['name','locale','country_id'];
    protected $table = 'country_translations';
    public $timestamps = false;
}

