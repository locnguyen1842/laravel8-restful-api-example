<?php

namespace App\Http\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\DataTransferObject\DataTransferObjectCollection;

class ResponseCollection extends DataTransferObject implements Responsable
{
    public DataTransferObjectCollection $collection;

    public ?LengthAwarePaginator $paginator;

    public ?array $additionalData = [];

    public int $status = 200;

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $response = array_merge($this->getArrayPagination(), $this->getData(), $this->additionalData);

        return response()->json($response,$this->status);
    }

    private function getArrayPagination()
    {
        return $this->paginator ?
        [
            'current_page' => (int) $this->paginator->currentPage(),
            'last_page' => (int) $this->paginator->lastPage(),
            'per_page' => (int) $this->paginator->perPage(),
            'total' => (int) $this->paginator->total(),
        ]
        : [];
    }

    private function getData()
    {
        return [
            'data' => $this->collection->toArray()
        ];
    }
}
