<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Student;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateStudentRequest extends FormRequest
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
            'fname' => 'string',
            'lname' => 'string',
            'email' => 'email:rfc,dns|unique:students,email|string',
            'phone' => 'unique:students,phone|string',
            'national_id' => 'unique:students,national_id|string'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(422, "Validation Errors", $validator->errors()));
    }
}
