<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    $rules = [];
                }
                break;
            case 'POST':
                {
                    $rules = [
                        'name_en' => 'required|string|max:20|min:3',
                        'name_ar' => 'required|string|max:20|min:3',
                        'description_en' => 'required|max:200|min:3',
                        'description_ar' => 'required|max:200|min:3',
                        'price' => 'required|numeric',
                        'cat_id' => 'required|exists:categories,id',
                        'image' => 'required|image||mimes:jpeg,png,jpg,gif,svg|max:15360',
                    ];
                }
                break;
            case 'PUT':
                $rules = [
                    'name_en' => 'required|string|max:20|min:3',
                    'name_ar' => 'required|string|max:20|min:3',
                    'description_en' => 'required|max:200|min:3',
                    'description_ar' => 'required|max:200|min:3',
                    'price' => 'required|numeric',
                    'cat_id' => 'required|exists:categories,id',
                    'image' => 'nullable|image||mimes:jpeg,png,jpg,gif,svg|max:15360',
                    'status' => 'nullable|in:0,1',
                ];
                break;
            case 'PATCH':
                {
                    $rules = [];
                }
                break;
            default:
                break;
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'name_en' => trans('admin.name_en'),
            'name_ar' => trans('admin.name_ar'),
            'description_en' => trans('admin.description_en'),
            'description_ar' => trans('admin.description_ar'),
            'cat_id' => trans('admin.category'),
            'price' => trans('admin.price'),
            'image' => trans('admin.image'),
        ];
    }
}
