<?php

namespace App\DTOs\Post;

use App\DTOs\BaseJsonResource;
use App\DTOs\User\UserResource;

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
