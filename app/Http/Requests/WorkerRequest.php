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
            'name' => 'required|max:25|unique:workers,name,' . $this->id,
            'age' => 'required|max:2',
            'address' => 'required',
            'phone' => 'required_without:id|regex:/[0-9]{11}/|unique:workers,phone,' . $this->id,
            'salary' => 'required|max:5',
            'per' => 'required',
            'store_id' => 'required',
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
            'name.required' => 'name field is required',
            'name.max' => 'name may not be greater than 25 characters',
            'name.unique' => 'name field should be unique',

            'age.required' => 'age field is required',
            'age.max' => 'age may not be greater than 2 characters',

            'address.required' => 'address field is required',

            'phone.required_without' => 'phone field is required',
            'phone.regex' => 'phone format is invalid',
            'phone.unique' => 'phone field should be unique',

            'salary.required' => 'salary field is required',
            'salary.max' => 'salary may not be greater than 5 characters',

            'per.required' => 'per field is required',

            'store_id.required' => 'store name field is required',
        ];
    }
}
