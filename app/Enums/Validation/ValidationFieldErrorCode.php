<?php

namespace App\Enums\Validation;

class ValidationFieldErrorCode extends BaseErrorCodeEnum
{
    public static function all()
    {
        return [
            'name' => '0001',
            'email' => '0002',
            'password' => '0003',
        ];
    }
}