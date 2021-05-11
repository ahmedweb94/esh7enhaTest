<?php

namespace App\Http\Requests\Front;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactUsRequest extends FormRequest
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
            'mobile' => 'required|numeric|digits_between:5,25',
            'email' => 'required|email|min:10|max:75',
            'title' => 'required|string|max:25|min:3',
            'message' => 'required|string|max:2000',
//            'type' => ['required', 'numeric', Rule::in([0, 1, 2, 3])],
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('admin.name'),
            'mobile' => trans('admin.mobile'),
            'email' => trans('admin.email'),
            'title' => trans('admin.title'),
            'message' => trans('admin.message'),
            'type' => trans('admin.type'),
        ];
    }

}
