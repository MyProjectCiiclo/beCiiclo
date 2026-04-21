<?php

namespace App\Services;

use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {



        $data['password'] = Hash::make($data['password']);

        if (!isset($data['role'])) {
            $data['role'] = 'user';
        }

        return $this->authRepository->createUser($data);
    }

    public function login(array $data)
    {
        $user = $this->authRepository->findByEmail($data);

        if (!$user) return null;

        $token = $user->createToken('login-token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
