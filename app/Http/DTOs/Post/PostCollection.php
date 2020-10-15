<?php

namespace App\Http\DTOs\Post;

use App\Http\DTOs\BaseResourceCollection;

class PostCollection extends BaseResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'data' => PostResource::collection($this->collection),
        ];
        
        return $this->toArrayWithPagination($data);
    }
}
