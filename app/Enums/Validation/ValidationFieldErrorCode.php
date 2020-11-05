<?php

namespace App\Enums\Validation;

class ValidationFieldErrorCode extends BaseErrorCodeEnum
{
    public static function all()
    {
        return array_unique([
            'name' => '0001',
            'email' => '0002',
            'password' => '0003',
            'title' => '0004',
            'summary' => '0005',
            'description' => '0006',
            'phone_number' => '0007',
            'role' => '0008',
        ]);
    }
}