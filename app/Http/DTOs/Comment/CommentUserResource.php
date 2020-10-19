<?php

namespace App\Http\DTOs\Comment;

use App\Http\DTOs\BaseJsonResource;
use App\Http\DTOs\Post\PostResource;
use App\Http\DTOs\User\UserResource;

class CommentUserResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'post' => new PostResource($this->post),
        ];
    }
}
