<?php

namespace App\Http\Requests\Location;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class StateRequest extends ApiRequest
{
    public function rules()
    {
            switch ($this->method()) {
                case 'GET': {
                    return [
                        'per_page' => ['sometimes', 'nullable', 'numeric', 'gte:1'],
                        'is_paginated' => ['nullable', 'in:1,0,true,false'],
                        'countries_ids' => ['nullable', 'array'],
                        'countries_ids.*' => ['numeric', 'exists:countries,id', 
                            Rule::requiredIf(function () {
                                return isset(request()->countries_ids) ;
                            }),
                        ],
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
                             Rule::unique('state_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'en');
                                 })
                        ],
                        'ar.name' => [
                            'required',
                            'max:255',
                             Rule::unique('state_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'ar');
                                 })
                        ],
                        'country_id' => ['required', 'numeric', 'exists:countries,id'],
                        'is_active' => ['nullable', 'boolean']
                    ];
                }
                case 'PUT':
                case 'PATCH': {
                    return [
                        'country_id' => ['nullable', 'numeric', 'exists:countries,id'],
                        'en.name' => [
                            'nullable',
                            'max:255',
                             Rule::unique('state_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'en')->where('state_id','!=',$this->id);
                                 })
                        ],
                        'ar.name' => [
                            'nullable',
                            'max:255',
                             Rule::unique('state_translations', 'name')
                                 ->where(function ($query) {
                                     $query->where('locale', 'ar')->where('state_id','!=',$this->id);
                                 })
                        ],
                        'is_active' => ['nullable', 'boolean']
                    ];
                }
                default:break;
    
                }
    }
}
