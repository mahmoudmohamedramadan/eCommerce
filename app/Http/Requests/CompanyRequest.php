<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required_without:id|max:25|unique:companies,name,' . $this->id,
            'phone' => 'required_without:id|regex:/[0-9]{11}/|unique:companies,phone,' . $this->id,
            'address' => 'required',
            'manager' => 'required',
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
            'name.required_without' => 'name_field_is_required',
            'name.max' => 'name_may_not_be_greater_than_25_characters',
            'name.unique' => 'name_field_should_be_unique',

            'phone.required_without' => 'phone_field_is_required',
            'phone.regex' => 'phone_format_is_invalid',
            'phone.unique' => 'phone_field_should_be_unique',

            'address.required' => 'address_field_is_required',
            'manager.required' => 'manager_field_is_required',
        ];
    }
}
