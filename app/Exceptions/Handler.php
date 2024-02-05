<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Responses\Error\ErrorResponse;
use App\Constants\Errors\CommonErrorConstants;
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
        }else if($e instanceof UnauthorizedException){
            $response = new ErrorResponse(
                type: CommonErrorConstants::TYPE_FORBIDDEN,
                title: CommonErrorConstants::TITLE_FORBIDDEN,
                status: Response::HTTP_FORBIDDEN,
                detail: CommonErrorConstants::DETAIL_FORBIDDEN,
            );
            return response()->json($response, $response->status);
        }

        return parent::render($request, $e);
    }
}
