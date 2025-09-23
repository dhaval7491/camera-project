<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuth
{
    /**
     * Handle an incoming request for API token authentication
     * This is specifically for the Janus server to authenticate
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get token from header or query parameter
        $token = $request->bearerToken() ?? $request->query('api_token');

        // Get the configured API token from environment
        $validToken = env('JANUS_API_TOKEN', 'your-secure-api-token-here');

        // Validate token
        if (!$token || $token !== $validToken) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Invalid or missing API token.'
            ], 401);
        }

        return $next($request);
    }
}