<?php

namespace App\Http\DTOs\User;

use App\Http\DTOs\BaseJsonResource;

class UserResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
