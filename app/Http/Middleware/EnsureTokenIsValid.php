<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->is('api/auth/register') ||
            $request->is('api/auth/login')
        ) {
            return $next($request);
        }

        $token = $request->bearerToken();

        if (!$token || $token !== 'my-secret-token') {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        return $next($request);
    }
}
