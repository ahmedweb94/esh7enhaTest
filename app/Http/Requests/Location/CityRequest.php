<?php

namespace App\Http\Requests\Location;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class CityRequest extends ApiRequest
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
                        'en.name' => [
                            'required',
                            'max:255',
                             Rule::unique('city_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'en');
                                 })
                        ],
                        'ar.name' => [
                            'required',
                            'max:255',
                             Rule::unique('city_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'ar');
                                 })
                        ],
                        'state_id' => ['required', 'numeric', 'exists:states,id'],
                        'is_main' => ['required', 'boolean'],
                        'is_active' => ['nullable', 'boolean'],
                        'zip_code' => ['required', 'string']
                    ];
                }
                case 'PUT':
                case 'PATCH': {
                    return [
                        'en.name' => [
                            'sometimes',
                            'max:255',
                             Rule::unique('city_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'en')->where('city_id','!=',$this->id);
                                 })
                        ],
                        'ar.name' => [
                            'sometimes',
                            'max:255',
                             Rule::unique('city_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'ar')->where('city_id','!=',$this->id);
                                 })
                        ],
                        'is_main' => ['nullable', 'boolean'],
                        'is_active' => ['nullable', 'boolean'],
                        'state_id' => ['sometimes', 'numeric', 'exists:states,id'],
                        'zip_code' => ['nullable', 'string']
                    ];
                }
                default:break;
    
                }
    }
}
