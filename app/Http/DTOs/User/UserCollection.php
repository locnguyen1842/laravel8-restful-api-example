<?php

namespace App\Http\DTOs\User;

use App\Http\DTOs\ModelCollection;

class UserCollection extends ModelCollection
{
    public static function resource()
    {
        return \App\Http\DTOs\User\UserResource::class;
    }
}
