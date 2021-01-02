<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
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
            'name' => 'required|unique:workers,name,' . $this->id,
            'age' => 'required|numeric',
            'national_id' => 'required|numeric|unique:workers,national_id,' . $this->id,
            'address' => 'required',
            'phone' => 'required|regex:/[0-9]{11}/|unique:workers,phone,' . $this->id,
            'salary' => 'required|numeric',
            'per' => 'required',
            'store_id' => 'required',
            'worker_permission' => 'required',
            'photo' => 'image|max:2500',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'name_field_is_required',
            'name.unique' => 'name_field_should_be_unique',

            'age.required' => 'age_field_is_required',
            'age.numeric' => 'age_must_be_a_number',

            'national_id.required' => 'national_id_field_is_required',
            'national_id.numeric' => 'national_id_field_must_be_a_number',
            'national_id.unique' => 'national_id_field_should_be_unique',

            'address.required' => 'address_field_is_required',

            'phone.required' => 'phone_field_is_required',
            'phone.regex' => 'phone_format_is_invalid',
            'phone.unique' => 'phone_field_should_be_unique',

            'salary.required' => 'salary_field_is_required',
            'salary.numeric' => 'salary_field_must_be_a_number',

            'per.required' => 'per_field_is_required',

            'store_id.required' => 'store_name_field_is_required',
            'worker_permission.required' => 'worker_permission_field_is_required',

            'photo.image' => 'photo_must_be_an_image',
            'photo.max' => 'photo_may_not_be_greater_than_2.5_mb',
        ];
    }
}
