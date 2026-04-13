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

    public function createUser(array $data)
    {
        return $this->authModel->create($data);
    }
}
