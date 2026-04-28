<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenNotFoundException;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!$request->bearerToken()) {
                return response()->json(['message' => 'Token not found'], 401);
            }

            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'Token expired'], 401);

        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'Token invalid'], 401);

        } catch (JWTException $e) {
            return response()->json(['message' => 'Token error'], 401);
        }

        return $next($request);
    }
}