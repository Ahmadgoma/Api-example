<?php


namespace App\Http\Requests;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiFormRequest extends FormRequest
{
    use ApiResponseTrait;

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(['error' => $validator->errors()->first()]));
    }
}
