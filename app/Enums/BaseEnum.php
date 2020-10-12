<?php

namespace App\Enums;

abstract class BaseEnum
{
    
    /**
     * @param bool
     * @return array
     */
    abstract static function getAll($withStatusID = false);
    
    /**
     * @param mixed
     * @return array
     */
    public static function findByName($statusName) {
        foreach(static::getAll(true) as $status) {
            if($status['name'] === $statusName) return $status;
        }

        return ['name' => null, 'id' => null];
    }

    public static function find($key) {
        foreach(static::getAll(true) as $status) {
            if($status['id'] === $key) return $status;
        }

        return null;
    }

    public static function isValid($statusName) {
        return \in_array($statusName, static::getAll(), true);
    }
}
