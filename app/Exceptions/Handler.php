<?php

namespace App\Exceptions;

use App\Constants\Errors\CommonErrorConstants;
use Illuminate\Auth\AuthenticationException;
use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Responses\Error\ErrorResponse;
use App\Constants\Errors\AuthErrorConstants;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Responses\Error\ValidationErrorResponse;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e): \Illuminate\Foundation\Application
    |\Illuminate\Http\Response
    |JsonResponse
    |Application
    |Response
    |RedirectResponse
    |ResponseFactory
    {
        if ($e instanceof ValidationException) {
            $validationErrorResponse = new ValidationErrorResponse($e->errors());

            return response()->json($validationErrorResponse, $validationErrorResponse->status);
        } else if ($e instanceof UnauthorizedException){
            $response = new ErrorResponse(
                type: AuthErrorConstants::TYPE_FORBIDDEN,
                title: AuthErrorConstants::TITLE_FORBIDDEN,
                status: Response::HTTP_FORBIDDEN,
                detail: AuthErrorConstants::DETAIL_FORBIDDEN,
            );

            return response()->json($response, $response->status);
        } else if ($e instanceof AuthenticationException){
            $response = new ErrorResponse(
                type: AuthErrorConstants::TYPE_UNAUTHORIZED,
                title: AuthErrorConstants::TITLE_UNAUTHORIZED,
                status: Response::HTTP_UNAUTHORIZED,
                detail: AuthErrorConstants::DETAIL_UNAUTHORIZED,

            );

            return response()->json($response, $response->status);
        } else {
            $response = new ErrorResponse(
                type: CommonErrorConstants::TYPE_INTERNAL_SERVER,
                title: CommonErrorConstants::TITLE_INTERNAL_SERVER,
                status: Response::HTTP_INTERNAL_SERVER_ERROR,
                detail: CommonErrorConstants::DETAILS_INTERNAL_SERVER,
            );
            
            return response()->json($response, $response->status);
        }

        // return parent::render($request, $e);
    }
}