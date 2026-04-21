<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            return response()->json([
                'message' => 'Login failed',
            ], 401);
        }

        return response()->json([
            'message' => 'Login success',
            'user' => $user,
        ]);
    }
}
