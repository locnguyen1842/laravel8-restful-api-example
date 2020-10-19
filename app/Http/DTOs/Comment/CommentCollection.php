<?php

namespace App\Http\DTOs\Comment;

use App\Http\DTOs\BaseResourceCollection;

class CommentCollection extends BaseResourceCollection
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
            'data' => CommentPostResource::collection($this->collection),
        ];
        
        return $this->toArrayWithPagination($data);
    }
}
