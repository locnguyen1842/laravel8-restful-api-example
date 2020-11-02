<?php

namespace App\Http\Controllers\Api;

use App\Http\DTOs\ModelCollection;
use App\Http\DTOs\ResponseCollection;
use App\Http\DTOs\ResponseResource;
use App\Http\DTOs\SimpleCollection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Spatie\DataTransferObject\DataTransferObject;

class BaseApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_NO_CONTENT = 204;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_BAD_GATEWAY = 502;

    public function responseNoContent($status = self::HTTP_NO_CONTENT, $headers = [])
    {
        response()->noContent($status, $headers);
    }

    public function responseFromResource($content = '', $status = self::HTTP_OK, $headers = [])
    {
        return response($content, $status, $headers);
    }
}
