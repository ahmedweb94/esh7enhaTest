<?php

namespace App\Http\Requests\Front\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'address_id' => 'required|exists:addresses,id',
            'payment_type' => 'required|in:cash,credit',
            'payment_method' => 'required_if:payment_type,credit',
            'delivery_time' => 'required|in:1,2,3',
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
            'address_id' => trans('admin.address'),
            'payment_type' => trans('admin.payment_type'),
            'payment_method' => trans('admin.payment_method'),
            'delivery_time' => trans('admin.delivery_time'),
        ];
    }
}
