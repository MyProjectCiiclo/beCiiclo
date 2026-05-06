<?php

namespace App\Services;

use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        $token = JWTAuth::fromUser($user);

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function login(array $data)
    {
        $user = $this->authRepository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }

        $token = JWTAuth::fromUser($user);

        return $token;
    } 


    public function getUser()
    {
        $user =$this->authRepository->getUser();
        return $user;
    }
}
