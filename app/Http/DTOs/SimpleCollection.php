<?php

namespace App\Http\DTOs;

class SimpleCollection extends BaseResourceCollection
{
    
    public $resourceClass;

    public $additional;

    public function __construct($resource, $resourceClass = null, $additional = []) {
        parent::__construct($resource);
        $this->resourceClass = $resourceClass;
        $this->additional = $additional;
    }

    public function toArray($request)
    {

        $data = [
            'data' => $this->resourceClass::collection($this->collection),
        ];
        
        return $this->toArrayWithPagination(array_merge($data, $this->additional));
    }
}
