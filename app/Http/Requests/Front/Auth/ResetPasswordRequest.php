<?php

namespace App\Http\Requests\Front\Auth;

use App\Helper\UsersType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResetPasswordRequest extends FormRequest
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
            'mobile' => ['required','digits:10','regex:/(05)[0-9]{8}/'],
            'type' => ['required'],
            'password'=>'required|min:6|string|confirmed',
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
            'mobile' => trans('admin.mobile'),
            'password' => trans('admin.new_password'),
        ];
    }
}
