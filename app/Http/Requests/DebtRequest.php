<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DebtRequest extends FormRequest
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
            'title' => 'required_without:id|unique:debts,title,' . $this->id,
            'details' => 'required|max:255',
            'pay_date' => 'required|date',
            'remember_date' => 'required|date',
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
            'title.required_without' => 'title field is required',
            'title.unique' => 'title field should be unique',

            'details.required' => 'details field is required',
            'details.max' => 'details may not be greater than 255 characters',

            'pay_date.required' => 'pay date field is required',
            'pay_date.date' => 'pay date must be a correct date',

            'remember_date.required' => 'remember date field is required',
            'remember_date.date' => 'remember date must be a correct date',
        ];
    }
}
