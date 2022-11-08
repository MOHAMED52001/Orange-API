<?php

namespace App\Http\Requests\Contracts;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'supplier_id' => 'required|integer',
            'course_id' => 'required|integer|unique:course_supplier_contract,course_id',
            'price' => 'required|numeric|between:0,99999.99',
            'course_state' => 'string|required',
            'course_place' => 'string|required',
        ];
    }
}
