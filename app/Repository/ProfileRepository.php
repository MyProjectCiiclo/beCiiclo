<?php

namespace App\Repository;

use App\Models\ProfileModel;

class ProfileRepository
{
    protected $profileModel;

    public function __construct(ProfileModel $profileModel)
    {
        $this->profileModel = $profileModel;
    }

    public function getProfile()
    {
        return $this->profileModel->with('skills')->first();
    }
}