<?php

namespace App\Http\Requests\Contracts;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreContractsRequest extends FormRequest
{
    use ApiResponseTrait;

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


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(422, "Validation Errors", $validator->errors()));
    }
}
