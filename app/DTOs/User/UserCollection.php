<?php

namespace App\DTOs\User;

use App\DTOs\BaseResourceCollection;

class UserCollection extends BaseResourceCollection
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
            'data' => UserResource::collection($this->collection)
        ];
        
        return $this->toArrayWithPagination($data);
    }

}
