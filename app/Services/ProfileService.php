<?php

namespace App\Services;

use App\Repository\ProfileRepository;

class ProfileService
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function getProfile()
    {
        return $this->profileRepository->getProfile();
    }
}