<?php

namespace App\DTOs;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseResourceCollection extends ResourceCollection
{
    public function __construct($resource) {
        parent::__construct($resource);
    }

    public function getArrayPagination()
    {
        return $this->resource instanceof LengthAwarePaginator ?
        [
            'current_page' => $this->resource->currentPage(),
            'last_page' => $this->resource->lastPage(),
            'per_page' => $this->resource->perPage(),
            'total' => $this->resource->total(),
        ] : 
        [];
    }

    public function toArrayWithPagination(array $array)
    {
        return array_merge($this->getArrayPagination(), $array);
    }
}
