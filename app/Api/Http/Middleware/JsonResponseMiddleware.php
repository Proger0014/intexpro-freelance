<?php

namespace App\Api\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\ResponseFactory;

class JsonResponseMiddleware
{
    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', 'application/json');


        $response = $next($request);

        if (!$response instanceof JsonResponse) {
            $response = $this->responseFactory->json(
                $response->getContent(),
                $response->getStatusCode(),
                $response->headers->all()
            );
        }

        return $response;
    }
}
