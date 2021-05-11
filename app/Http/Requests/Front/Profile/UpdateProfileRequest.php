<?php

namespace App\Http\Requests\Front\Profile;

use App\Helper\UsersType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'mobile' => ['required',Rule::unique('users')->ignore(auth()->id())->where('type',UsersType::Client),'digits:10','regex:/(05)[0-9]{8}/'],
            'image' => 'nullable|image||mimes:jpeg,png,jpg,gif,svg|max:15360',
        ];
    }

//    public function validated()
//    {
////        return array_merge(parent::validated(), [
////            'type' => UsersType::Client,
////        ]);
//    }

    public function attributes()
    {
        return [
            'mobile' => trans('admin.mobile'),
            'password' => trans('admin.password'),
            'name' => trans('admin.name'),
            'image' => trans('admin.image'),
        ];
    }
}
