<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditPageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'value_ar' => 'required|string|min:3',
            'value_en' => 'required|string|min:3',

        ];

    }

    public function attributes()
    {
        return [
            'value_en' => trans('admin.value_en'),
            'value_ar' => trans('admin.value_ar'),
        ];
    }
}
