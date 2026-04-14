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
        $data['password'] = Hash::make($data['password']);

        if (!isset($data['role'])) {
            $data['role'] = 'user';
        }

        return $this->authRepository->createUser($data);
    }

    public function login(array $data)
    {
        return $this->authRepository->login($data);
    }
}
