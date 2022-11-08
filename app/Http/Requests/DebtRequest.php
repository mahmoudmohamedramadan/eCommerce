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
            'title.required_without' => 'title_field_is_required',
            'title.unique' => 'title_field_should_be_unique',

            'details.required' => 'details_field_is_required',
            'details.max' => 'details_may_not_be_greater_than_255_characters',

            'pay_date.required' => 'pay_date_field_is_required',
            'pay_date.date' => 'pay_date_must_be_a_correct_date',

            'remember_date.required' => 'remember_date_field_is_required',
            'remember_date.date' => 'remember_date_must_be_a_correct_date',
        ];
    }
}
