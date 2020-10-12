<?php

namespace App\Http\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Contracts\Support\Responsable;

class ResponseResource extends DataTransferObject implements Responsable
{
    /** @var \Spatie\DataTransferObject\DataTransferObject|\Spatie\DataTransferObject\DataTransferObjectCollection */
    public $data;

    public int $status = 200;

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $response = array_merge($this->getData());

        return response()->json($response,$this->status);
    }

    private function getData()
    {
        return $this->data->toArray();
    }
}
