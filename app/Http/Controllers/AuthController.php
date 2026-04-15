<?php

namespace App\Http\Controllers;

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

    public function register(Request $request)
    {
        
    dd([
        'database' => DB::connection()->getDatabaseName(),
        'host' => config('database.connections.pgsql.host'),
    ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Thêm unique:users
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->only(['name', 'email', 'password']);

        $user = $this->authService->register($data);
        return response()->json([
            'message' => 'Success Register',
            'user' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $data = $request->only(['email', 'password']);

        $user = $this->authService->login($data);

        return response()->json([
            'message' => 'Login success',
            'user' => $user,
        ]);
    }
}
