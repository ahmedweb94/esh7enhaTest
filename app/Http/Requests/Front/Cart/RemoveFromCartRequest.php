<?php

namespace App\Http\Requests\Front\Cart;

use Illuminate\Foundation\Http\FormRequest;

class RemoveFromCartRequest extends FormRequest
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
            'cart_id'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            'cart_id' => trans('admin.cart'),
        ];
    }
}
