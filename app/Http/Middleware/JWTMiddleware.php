<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Attempt to authenticate the user using the token
            // This will also validate the token (signature, expiration, etc.)
            $user = JWTAuth::parseToken()->authenticate();

            // If authentication fails (e.g., token is invalid or user not found),
            // authenticate() will throw an exception.
            // If it succeeds, $user will be the authenticated user model.

            // If no user is found for the token, it's also an authentication failure.
            if (!$user) {
                return response()->json(['message' => 'User not found for this token'], 401);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'Token has expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token not provided or malformed'], 401);
        } catch (\Throwable $e) {
            // Catch any other unexpected errors, which might indicate a server-side issue
            return response()->json(['message' => 'Authentication error', 'error' => $e->getMessage()], 500);
        }

        // If the token is valid and user is authenticated, proceed with the request
        return $next($request);
    }
}
