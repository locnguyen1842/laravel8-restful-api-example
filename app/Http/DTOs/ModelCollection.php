<?php

namespace App\Http\DTOs;

use Spatie\DataTransferObject\DataTransferObjectCollection;
use Illuminate\Database\Eloquent\Model;

abstract class ModelCollection extends DataTransferObjectCollection
{
    /** @return string */
    public static abstract function resource();
    /**
     * @param  Model[]  $data
     * @return UserCollection
     */
    public static function fromResource(array $data)
    {
        $resource = static::resource();
        
        return new static(
            array_map(
                function($item) use ($resource) {
                    return (new \ReflectionClass($resource))
                        ->newInstanceWithoutConstructor()
                        ->fromModel($item);
                }
            , $data)
        );
    }
}
