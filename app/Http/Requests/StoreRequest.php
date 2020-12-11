<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required_without:id|max:25|unique:stores,name,' . $this->id,
            'phone' => 'required_without:id|regex:/[0-9]{11}/|unique:stores,phone,' . $this->id,
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
            'name.required_without' => 'name field is required',
            'name.max' => 'name may not be greater than 25 characters',
            'name.unique' => 'name field should be unique',

            'phone.required_without' => 'phone field is required',
            'phone.regex' => 'phone format is invalid',
            'phone.unique' => 'phone field should be unique',
            
            'address.required' => 'address field is required',
            'manager.required' => 'manager field is required',
        ];
    }
}
