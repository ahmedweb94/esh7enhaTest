<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryFormRequest extends FormRequest
{
    public function rules()
    {
            switch ($this->method()) {
                case 'GET': {
                    return [
                        'per_page' => ['sometimes', 'nullable', 'numeric', 'gte:1'],
                        'is_paginated' => ['nullable', 'in:1,0,true,false']
                    ];
                }
                case 'DELETE': {
                    return [];
                }
                case 'POST': {
                    return [
                        'code' => ['nullable', 'string', 'min:2', 'max:50', 'unique:countries,code'],
//                        'name:en' => [
//                            'required',
//                            'max:255',
//                            Rule::unique('country_translations', 'name')
//                                ->where(function ($query) {
//                                    $query->where('locale', 'en');
//                                })
//                        ],
//                        'name:ar' => [
//                            'required',
//                            'max:255',
//                            Rule::unique('country_translations', 'name')
//                                ->where(function ($query) {
//                                    $query->where('locale', 'ar');
//                                })
//                        ],
//                        'name:ur' => [
//                            'required',
//                            'max:255',
//                            Rule::unique('country_translations', 'name')
//                                ->where(function ($query) {
//                                    $query->where('locale', 'ur');
//                                })
//                        ],
                        'en.name' => [
                            'required',
                            'max:255',
                            Rule::unique('country_translations', 'name')
                                ->where(function ($query) {
                                    $query->where('locale', 'en');
                                })
                        ],
                        'ar.name' => [
                            'required',
                            'max:255',
                            Rule::unique('country_translations', 'name')
                                ->where(function ($query) {
                                    $query->where('locale', 'ar');
                                })
                        ],
                        'ur.name' => [
//                            'required',
                            'max:255',
                            Rule::unique('country_translations', 'name')
                                ->where(function ($query) {
                                    $query->where('locale', 'ur');
                                })
                        ],
                    ];
                }
                case 'PUT':
                case 'PATCH': {
                    return [
                        'code' => ['nullable', 'string', 'min:2', 'max:50', 'unique:countries,code,'.$this->country],
                        'name:en' => [
                            'sometimes',
                            'max:255',
                             Rule::unique('country_translations', 'name')
                                ->where(function ($query) {
                                    $query->where('locale', 'en')->where('country_id','!=',$this->country);
                                })
                        ],
                        'name:ar' => [
                            'sometimes',
                            'max:255',
                             Rule::unique('country_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'ar')->where('country_id','!=',$this->country);
                                 })
                        ],
                        'name:ur' => [
                            'sometimes',
                            'max:255',
                             Rule::unique('country_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'ur')->where('country_id','!=',$this->id);
                                 })
                        ],
                        'is_active' => ['sometimes', 'numeric']
                    ];
                }
                default:break;
    
                }
    }

    public function attributes()
    {
        return [
            'en.name'=>trans('admin.name') .' '. trans('admin.en'),
            'ar.name'=>trans('admin.name') .' '. trans('admin.ar'),
            'ur.name'=>trans('admin.name') .' '. trans('admin.ur'),
        ];
    }
}
