<?php

namespace App\Http\DTOs\User;

use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;

class UserResource extends DataTransferObject
{
    public int $id;

    public string $name;

    public string $email;
    
    public static function fromModel(User $user)
    {
        return new static([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
