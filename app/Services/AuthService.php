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
    public function login(array $data)
    {
        $user = $this->authRepository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return false;
        }

        return $user->createToken('api-token')->plainTextToken;
    }

    public function getUser()
    {
        return $this->authRepository->findByEmail(env('ADMIN_EMAIL'));
    }

    public function updateUser(array $data)
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        return $this->authRepository->update($user->id, $data);
    }

    public function logout($user)
    {
        return $this->authRepository->logout($user);
    }
}
