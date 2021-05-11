<?php

namespace App\Http\Requests\Front\Auth;

use App\Helper\UsersType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckCodeRequest extends FormRequest
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
            'code' => 'required|array|max:4|min:4',
            'mobile' => 'nullable','digits_between:5,15',
            'type' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'mobile' => trans('admin.mobile'),
            'code' => trans('admin.code'),
            'type' => trans('admin.type'),
        ];
    }
}
