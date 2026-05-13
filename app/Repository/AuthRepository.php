<?php

namespace App\Repository;

use App\Models\AuthModel;

class AuthRepository
{
    protected $authModel;
    public function __construct(AuthModel $authModel)
    {
        $this->authModel = $authModel;
    }

    public function findByEmail($email)
    {
        return AuthModel::where('email', $email)->first();
    }

    public function create(array $data)
    {
        return AuthModel::create($data);
    }
}
