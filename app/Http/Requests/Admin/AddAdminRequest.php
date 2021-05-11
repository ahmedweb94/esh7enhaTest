<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddAdminRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|min:6|email|unique:admins,email',
            'password' => 'required|min:6|max:32|confirmed',
            'mobile' => 'required|digits_between:5,25|unique:admins,mobile',
//            'roles' => 'required|array',
        ];

    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'password' => bcrypt($this->password),
        ]);
    }

    public function attributes()
    {
        return [
            'name' => trans('admin.name'),
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
        ];
    }
}
