<?php

namespace App\Http\Requests\Front\Profile;

use App\Helper\UsersType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMobileRequest extends FormRequest
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
            'code' => 'required',
        ];
    }

    public function validated()
    {
//        return array_merge(parent::validated(), [
//            'type' => UsersType::Client,
//        ]);
    }

    public function attributes()
    {
        return [
            'mobile' => trans('admin.mobile'),
            'code' => trans('admin.code'),
            'name' => trans('admin.name'),
            'image' => trans('admin.image'),
        ];
    }
}
