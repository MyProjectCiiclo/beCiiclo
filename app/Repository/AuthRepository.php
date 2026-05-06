<?php

namespace App\Repository;

use App\Models\AuthModel;
use Illuminate\Support\Facades\Auth;

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

    public function findByEmail($email)
    {
        return $this->authModel->where('email', $email)->first();
    }

    public function getUser()
    {
        return Auth::user();
    }
}
