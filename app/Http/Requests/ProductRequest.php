<?php

namespace App\Http\Requests;

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
        return [
            'name' => 'required_without:id|max:25|unique:products,name,' . $this->id,
            'price' => 'required|numeric',
            'company_id' => 'required',
            'total_quantity' => 'required|numeric',
            'used_quantity' => 'required|numeric',
            'stored_quantity' => 'required|numeric',
            'photo' => 'image|mimes:png,jpg|max:2500',
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

            'price.required' => 'price field is required',
            'price.numeric' => 'price must be a number',

            'company_id.required' => 'company name field is required',

            'total_quantity.required' => 'total quantity field is required',
            'total_quantity.numeric' => 'total quantity must be a number',

            'used_quantity.required' => 'used quantity field is required',
            'used_quantity.numeric' => 'product used quantity must be a number',
            
            'stored_quantity.required' => 'stored quantity field is required',
            'stored_quantity.numeric' => 'stored quantity must be a number',
        ];
    }
}
