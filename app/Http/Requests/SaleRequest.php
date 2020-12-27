<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'product_name' => 'required|array',
            'quantity' => 'required|array',
            'once_price' => 'required|array',
            'total_price' => 'required|numeric',
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
            'product_name.required' => 'name_field_is_required',

            'quantity.required' => 'quantity_field_is_required',
            'quantity.array' => 'quantity_field_must_be_a_array',

            'once_price.required' => 'once_price_field_is_required',
            'once_price.array' => 'once_price_field_must_be_a_array',

            'total_price.required' => 'total_price_field_is_required',
            'total_price.numeric' => 'total_price_field_must_be_a_number',
        ];
    }
}
