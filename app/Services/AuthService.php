<?php

namespace App\Services;

use App\Repository\AuthRepository;
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
        unset($data['password_confirmation']);

        $data['password'] = Hash::make($data['password']);

        if (!isset($data['role'])) {
            $data['role'] = 'user';
        }

        $user = $this->authRepository->createUser($data);

        $token = $user->createToken('register-token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function login(array $data)
    {
        $user = $this->authRepository->findByEmail($data['email']);

        if (!$user) {
            return null;
        }

        if (!Hash::check($data['password'], $user->password)) {
            return null;
        }

        $token = $user->createToken('login-token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
