<?php

namespace App\Http\Requests\Front\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password'=>'required|min:6|string',
            'password'=>'required|min:6|string|confirmed',
        ];
    }

//    public function validated()
//    {
//        return array_merge(parent::validated(), [
//            'password' => bcrypt($this->password),
//        ]);
//    }

    public function attributes()
    {
        return [
            'old_password' => trans('admin.old_password'),
            'password' => trans('admin.new_password'),
        ];
    }
}
