<?php

namespace App\Http\Requests\Front\Address;

use Illuminate\Foundation\Http\FormRequest;

class AddAddressRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'city_id' => 'required',
            'default' => 'nullable',
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'user_id' => auth()->id(),
        ]);
    }

    public function attributes()
    {
        return [
            'name' => trans('admin.name'),
            'address' => trans('admin.address'),
            'city_id' => trans('admin.city'),
        ];
    }
}
