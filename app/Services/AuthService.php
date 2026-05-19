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

    public function login(array $data)
    {
        if (
            $data['email'] === env('ADMIN_EMAIL') &&
            $data['password'] === env('ADMIN_PASSWORD')
        ) {

            $user = $this->authRepository->findByEmail($data['email']);

            if (!$user || !Hash::check($data['password'], $user->password)) {
                return false;
            }

            return $user->createToken('api-token')->plainTextToken;
        }

        return false;
    }

    public function getUser()
    {
        return $this->authRepository->findByEmail(env('ADMIN_EMAIL'));
    }

    public function updateUser(array $data)
    {
        $user = auth()->user();

        if (!$user) {
            return null;
        }

        return $this->authRepository->update($user->id, $data);
    }
}
