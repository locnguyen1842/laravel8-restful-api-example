<?php

namespace App\Exceptions;

use App\Enums\Validation\ValidationFieldErrorCode;
use App\Enums\Validation\ValidationRuleErrorCode;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, \Throwable $exception) {
        // if(!app()->environment('local', 'development')) {
        //     return response(['message' => 'Page not found'], Response::HTTP_NOT_FOUND);
        // }

        return $this->debugRender($request, $exception);
    }

    public function debugRender($request, \Throwable $e)
    {   
        if($e instanceof Responsable) {
            return $e->toResponse($request);
        }

        $e = $this->prepareException($this->mapException($e));

        foreach ($this->renderCallbacks as $renderCallback) {
            if (is_a($e, $this->firstClosureParameterType($renderCallback))) {
                $response = $renderCallback($e, $request);

                if (! is_null($response)) {
                    return $response;
                }
            }
        }
        
        return $this->jsonMessageRender($request, $e, true);
    }

    private function jsonMessageRender($request,\Throwable $e, $debugging = false)
    {

        switch (true) {
            case $e instanceof HttpResponseException:

                return $e->getResponse();

                break;
            case $e instanceof AuthorizationException:

                return $this->unauthorizedJsonMessage();

                break;
            case $e instanceof AuthenticationException:

                return $this->unauthenticatedJsonMessage();

                break;
            case $e instanceof AccessDeniedHttpException:

                return $this->unauthenticatedJsonMessage();

                break;
            case $e instanceof InputValidationAPIException:

                return $this->convertValidationAPIExceptionToResponse($e, $request);

                break;
            default:

                return $debugging ? $this->prepareJsonResponse($request, $e) :  response(['message' => 'Page not found'], 404);

                break;
        }
    }
    
    /**
     * Create a response object from the given validation exception.
     *
     * @param  InputValidationAPIException  $exception
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function convertValidationAPIExceptionToResponse(InputValidationAPIException $exception, $request)
    {
        if ($exception->response) {
            return $exception->response;
        }

        $failed = $exception->failed();

        $messages = $exception->errors();
        
        $fieldCodeErrors = ValidationFieldErrorCode::all();

        $validationRuleCodeErrors = ValidationRuleErrorCode::all();

        $errorResponse = [];

        foreach($failed as $field => $rules){
            $index = 0;
            foreach($rules as $rule => $parameters){
                $fieldCode = $fieldCodeErrors[$field] ?? $field;
                $ruleCode = $validationRuleCodeErrors[$rule] ?? $rule;
                $errorResponse[] = [
                    'error' => $fieldCode.$ruleCode,
                    'field' => $field,
                    'message' => $messages[$field][$index],
                ];
                $index++;
            }
        }

        return response()->json([
            'message' => $exception->getMessage(),
            'errors' => $errorResponse,
        ], $exception->status);
    }

    private function unauthorizedJsonMessage() {
        return response()->json([
            'message' => 'Unauthorized.'
        ], 401);
    }
    
    private function unauthenticatedJsonMessage() {
        return response()->json([
            'message' => 'Unauthenticated.'
        ], 403);
    }
}
