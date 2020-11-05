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
            'phone_number' => $this->phone_number,
            'phone_country' => $this->parsed_phone_number->getCountry(),
        ];
    }
}
