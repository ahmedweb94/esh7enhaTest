<?php

namespace App\Http\Requests\Front\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'qty' => 'nullable|int',
        ];
    }

    public function validated()
    {
        if (!$this->qty) {
            return array_merge(parent::validated(), [
                'qty' => 1,
            ]);
        }else{
            return parent::validated();
        }
    }

    public function attributes()
    {
        return [
            'product_id' => trans('admin.product'),
            'qty' => trans('admin.qty'),
        ];
    }
}
