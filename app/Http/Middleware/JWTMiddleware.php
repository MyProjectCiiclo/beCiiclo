<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = JWTAuth::parseToken();

            return response()->json([
                'message' => 'token parsed'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Auth error',
                'error' => $e->getMessage()
            ], 401);
        }
    }
}
