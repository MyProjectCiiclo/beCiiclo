<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    // public function handle(Request $request, Closure $next)
    // {
    //     try {
    //         $token = $request->bearerToken();

    //         if (!$token) {
    //             return response()->json([
    //                 'message' => 'Token not found'
    //             ], 401);
    //         }

    //         JWTAuth::setToken($token);

    //         $user = JWTAuth::authenticate();

    //         if (!$user) {
    //             return response()->json([
    //                 'message' => 'Unauthorized'
    //             ], 401);
    //         }
    //     } catch (\Throwable $e) {
    //         return response()->json([
    //             'message' => 'Auth error',
    //             'error' => $e->getMessage()
    //         ], 401);
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        return response()->json([
            'message' => 'jwt middleware reached'
        ]);
    }
}
