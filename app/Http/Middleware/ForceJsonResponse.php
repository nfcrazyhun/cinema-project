<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Forces the response to be in JSON format.
 *
 * This middleware sets the 'Accept' header of the incoming request to 'application/json',
 * ensuring that the response from the application is always in JSON format.
 *
 * @see https://dev.to/arxeiss/force-json-response-on-all-api-routes-in-laravel-29h
 */
class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request The incoming request
     * @param Closure $next The next middleware or controller to handle the request
     *
     * @return Response The response from the application, forced to be in JSON format
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
