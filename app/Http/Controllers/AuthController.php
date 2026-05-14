<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return response()->json([
            'message' => 'Success Get User',
            'user' => $this->authService->getUser(),
        ]);
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authService->login($request->validated());

        if (!$token) {
            throw ValidationException::withMessages([
                'email' => ['Only admin can login']
            ]);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    public function updateUser(Request $request)
    {
        $data = $request->only(['name', 'password']);

        $data = array_filter($data);

        if (empty($data)) {
            return response()->json([
                'message' => 'Please enter data to update'
            ], 422);
        }

        $user = $this->authService->updateUser($data);

        return response()->json([
            'message' => 'Success Update User',
            'user' => $user,
        ]);
    }
}
