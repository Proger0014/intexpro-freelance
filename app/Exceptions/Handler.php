<?php

namespace App\Exceptions;

use App\Http\Responses\Error\HasValidationErrorResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use HasValidationErrorResponse;
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
            return response()->json(
                $this->getValidationErrorResponse($e->errors()),
                $this->VALIDATION_ERROR_RESPONSE_CODE);
        }

        return parent::render($request, $e);
    }
}
