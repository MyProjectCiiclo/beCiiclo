<?php

namespace App\Repository;

use App\Models\AuthModel;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    protected $authModel;

    public function __construct(AuthModel $authModel)
    {
        $this->authModel = $authModel;
    }

    public function createUser(array $data)
    {
        return $this->authModel->create($data);
    }

    public function login(array $data)
    {
        $user = $this->authModel->where('email', $data['email'])->first();

        // check user tồn tại
        if (!$user) {
            throw new \Exception('User not found');
        }

        // check password
        if (!Hash::check($data['password'], $user->password)) {
            throw new \Exception('Wrong password');
        }

        return $user;
    }
}