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
            'name' => 'required|unique:products,name,' . $this->id,
            'price' => 'required|numeric',
            'company_id' => 'required',
            'total_quantity' => 'required|numeric',
            'used_quantity' => 'required|numeric',
            'stored_quantity' => 'required|numeric',
            'minimum_used' => 'required|numeric',
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

            'price.required' => 'price_field_is_required',
            'price.numeric' => 'price_must_be_a_number',

            'company_id.required' => 'company_name_field_is_required',

            'total_quantity.required' => 'total_quantity_field_is_required',
            'total_quantity.numeric' => 'total_quantity_must_be_a_number',

            'used_quantity.required' => 'used_quantity_field_is_required',
            'used_quantity.numeric' => 'product_used_quantity_must_be_a_number',

            'stored_quantity.required' => 'stored_quantity_field_is_required',
            'stored_quantity.numeric' => 'stored_quantity_must_be_a_number',

            'minimum_used.required' => 'minimum_used_field_is_required',
            'minimum_used.numeric' => 'minimum_used_must_be_a_number',

            'photo.image' => 'photo_must_be_an_image',
            'photo.max' => 'photo_may_not_be_greater_than_2.5_mb',
        ];
    }
}
