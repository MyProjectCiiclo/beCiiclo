<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->only(['name', 'email', 'password']);

        $user = $this->authService->register($data);
        return response()->json([
            'message' => 'Success Register',
            'user' => $user,
        ]);
    }
}
