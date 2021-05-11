<?php

namespace App\Http\Requests\Admin;

use App\Helper\UsersType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DriverRequest extends FormRequest
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
                        'name' => 'required|string|max:20|min:3',
                        'mobile' => ['required','string','max:15','min:9',Rule::unique('users','mobile')->where('type',UsersType::Driver)],
                        'identity' => 'required|max:20|min:8',
                        'identity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:15360',
                        'vehicle_type' => 'nullable|string',
                        'vehicle_number' => 'nullable|max:10|min:3',
                        'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:15360',
                    ];
                }
                break;
            case 'PUT':
                $rules = [
                    'name' => 'required|string|max:20|min:3',
                    'mobile' => ['required','string','max:15','min:9',Rule::unique('users','mobile')->ignore($this->driver)->where('type',UsersType::Driver)],
                    'identity' => 'required|max:20|min:8',
                    'identity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:15360',
                    'vehicle_type' => 'nullable|string',
                    'vehicle_number' => 'nullable|max:10|min:3',
                    'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:15360',
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
            'name' => trans('admin.name'),
            'mobile' => trans('admin.mobile'),
            'identity' => trans('admin.identity'),
            'identity_image' => trans('admin.identity_image'),
            'vehicle_type' => trans('admin.vehicle_type'),
            'vehicle_number' => trans('admin.vehicle_number'),
            'vehicle_image' => trans('admin.vehicle_image'),
        ];
    }
}
