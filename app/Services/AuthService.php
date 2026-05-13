<?php

namespace App\Services;

use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(array $data)
    {
        if (
            $data['email'] === env('ADMIN_EMAIL') &&
            $data['password'] === env('ADMIN_PASSWORD')
        ) {
            $user = $this->authRepository->findByEmail(env('ADMIN_EMAIL'));

            if (!$user) {
                $user = $this->authRepository->create([
                    'name' => 'Admin',
                    'email' => env('ADMIN_EMAIL'),
                    'password' => Hash::make(env('ADMIN_PASSWORD')),
                    'role' => 'admin'
                ]);
            }

            return JWTAuth::fromUser($user);
        }

        return false;
    }

    public function getUser()
    {
        return [
            'email' => env('ADMIN_EMAIL'),
            'role' => 'admin',
        ];
    }
}