<?php

namespace App\Enums;

use ReflectionClass;

abstract class BaseEnum
{
    public abstract static function all(): array;
    
    /**
     * @param  mixed $statusName
     * @return  array
     */
    public static function findByName($name) {
        foreach(static::all() as $status) {
            if($status['name'] === $name) return $status;
        }

        return ['name' => null, 'id' => null];
    }

    public static function find($key) {
        foreach(static::all() as $status) {
            if($status['id'] === $key) return $status;
        }

        return null;
    }

    public static function isValid($name) {
        return \in_array($name, static::all(), true);
    }

    public static function getClassConstants()
    {
        $class = new ReflectionClass(static::class);
        return $class->getConstants();
    }
}
