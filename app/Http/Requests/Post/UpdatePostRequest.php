<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseFormRequest;

class UpdatePostRequest extends BaseFormRequest
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
            'title' => 'required',
            'summary' => 'required',
            'description' => 'nullable',
        ];
    }
}
