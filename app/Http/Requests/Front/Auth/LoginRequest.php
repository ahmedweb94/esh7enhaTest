<?php

namespace App\Http\Requests\Front\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile'=>'required|digits:10|regex:/(05)[0-9]{8}/|numeric',
            'password'=>'required|min:6|string',
            'remember'=>'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'mobile' => trans('admin.mobile'),
            'password' => trans('admin.password'),
        ];
    }
}
