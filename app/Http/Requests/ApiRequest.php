<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;


abstract class ApiRequest extends FormRequest
{
    use ApiResponse;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiError(
            $validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY,
        ));
    }


    protected function failedAuthorization()
    {
        throw new HttpResponseException($this->apiError(
            null,
            Response::HTTP_UNAUTHORIZED
        ));
    }

    
}
