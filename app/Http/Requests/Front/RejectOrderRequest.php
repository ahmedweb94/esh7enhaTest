<?php

namespace App\Http\Requests\Front;


use Illuminate\Foundation\Http\FormRequest;

class RejectOrderRequest extends FormRequest
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
            'order_id' => 'required|exists:orders,id',
            'reason' => 'required|string|max:2000',
//            'type' => ['required', 'numeric', Rule::in([0, 1, 2, 3])],
        ];
    }

    public function attributes()
    {
        return [
            'reason' => trans('admin.reason'),
            'order_id' => trans('admin.order'),
        ];
    }

}
