<?php

namespace App\Enums;

class UserStatuses extends BaseEnum
{
    const USER_ACTIVE = 'ACTIVE';
    const USER_INACTIVE = 'INACTIVE';

    public static function all() : array
    {
        return [
            self::USER_ACTIVE,
            self::USER_INACTIVE
        ];
    }
}