<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Support\Facades\Auth;

class CommentOnPostCommentRequest extends BaseFormRequest
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
            'content' => 'required',
            'user_id' => 'required|exists:\App\Models\User,id',
            'post_id' => 'required|exists:\App\Models\Post,id'
        ];
    }
    
    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id,
            'post_id' => $this->post->id
        ]);
    }
}
