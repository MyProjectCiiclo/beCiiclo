<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {

        $user = $this->authService->register($request->validated());
        return response()->json([
            'message' => 'Success Register',
            'user' => $user,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authService->login($request->validated());

        if (!$token) {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password']
            ]);
        }

        return $this->respondWithToken($token);
    }


    public function respondWithToken($token)
    {
        $cookie = cookie(
            "token",
            $token,
            30,
            "/",
            null,
            false,
            true,
            false,
            "Strict",
        );

        return response()->json([
            'message' => 'Success Login',
            'token' => $token
        ])->cookie($cookie);
    }
}
