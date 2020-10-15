<?php

namespace App\Http\DTOs\Post;

use App\Http\DTOs\BaseJsonResource;
use App\Http\DTOs\User\UserResource;

class PostResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->summary,
            'description' => $this->description,
            'user' => new UserResource($this->user),
        ];
    }
}
