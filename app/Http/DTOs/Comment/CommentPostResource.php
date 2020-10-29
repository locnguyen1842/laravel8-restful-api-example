<?php

namespace App\Http\DTOs\Comment;

use App\Http\DTOs\BaseJsonResource;
use App\Http\DTOs\User\UserResource;

class CommentPostResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'user' => new UserResource($this->user),
        ];
    }
}
