<?php

namespace App\Enums\Validation;

abstract class BaseErrorCodeEnum
{
    /** @return array */
    abstract static function all();
    
    public static function find($key) {
        return static::all()[$key] ?? null;
    }

    public static function isValidCode($code) {
        return \in_array($code, static::all(), true);
    }
    
    public static function isValid($key) {
        return static::all()[$key] ? true : false;
    }
}