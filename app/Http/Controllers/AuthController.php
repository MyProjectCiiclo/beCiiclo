<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;


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

       $user = $this->authService->login($request->validated());

        if(!$user){
           throw new AuthenticationException('Invalid email or password');
        }

        return response()->json([
            'message' => 'Login success',
            'user' => $user,
        ]);
    }
}
