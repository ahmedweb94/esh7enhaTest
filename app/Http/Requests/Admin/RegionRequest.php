<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
                        'name_en' => 'required|string|max:20|min:3|unique:regions,name_en',
                        'name_ar' => 'required|string|max:20|min:3|unique:regions,name_ar',
                        'code' => 'required|string',
                    ];
                }
                break;
            case 'PUT':
                $rules = [
                    'name_en' => 'required|string|max:20|min:3|unique:regions,name_en,'.$this->region,
                    'name_ar' => 'required|string|max:20|min:3|unique:regions,name_ar,'.$this->region,
                    'code' => 'required|string',
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
            'code' => trans('admin.code'),
        ];
    }
}
