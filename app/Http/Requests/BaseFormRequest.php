<?php

namespace App\Http\Requests;

use App\Exceptions\InputValidationAPIException;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;

abstract class BaseFormRequest extends FormRequest
{
    
    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @return void
     *
     * @throws InputValidationAPIException
     */
    public function failedValidation(Validator $validator)
    {
        throw new InputValidationAPIException($validator);
    }
}
