<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminResetPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required',
            'password' => 'required|min:6|max:32|confirmed',
        ];

    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'password' => bcrypt($this->password),
        ]);
    }

//    public function attributes()
//    {
//        return [
//            'code' => trans('admin.code'),
//            'password' => trans('admin.password'),
//        ];
//    }
}
