<?php

namespace App\Enums;

class UserStatuses extends BaseEnum
{
    const USER_ACTIVE = 'ACTIVE';
    const USER_INACTIVE = 'INACTIVE';

    public static function all() : array
    {
        return array_values(static::getClassConstants());
    }
}