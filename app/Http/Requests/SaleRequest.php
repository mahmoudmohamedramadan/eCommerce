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
            'product_name.required' => 'name field is required',

            'quantity.required' => 'quantity field is required',
            'quantity.array' => 'quantity field must be a array',

            'once_price.required' => 'once price field is required',
            'once_price.array' => 'once price field must be a array',

            'total_price.required' => 'total price field is required',
            'total_price.numeric' => 'total price field must be a number',
        ];
    }
}
