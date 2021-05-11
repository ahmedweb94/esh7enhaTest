<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditSocialPageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'value' => 'required|string',
        ];

    }

    public function attributes()
    {
        return [
            'value' => trans('admin.value'),
        ];
    }
}
