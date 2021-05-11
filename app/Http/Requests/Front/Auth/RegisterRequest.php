<?php

namespace App\Http\Requests\Front\Auth;

use App\Helper\UsersType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:20|min:3',
//            'email' => ['required','min:6','email',Rule::unique('users')->where('type',UsersType::Client)],
            'mobile' => ['required',Rule::unique('users')->where('type',UsersType::Client),'digits:10','regex:/(05)[0-9]{8}/'],
            'password'=>'required|min:6|string|confirmed',
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'type' => UsersType::Client,
            'password' => bcrypt($this->password),
        ]);
    }

    public function attributes()
    {
        return [
            'mobile' => trans('admin.mobile'),
            'password' => trans('admin.password'),
            'name' => trans('admin.name'),
            'email' => trans('admin.email'),
        ];
    }
}
