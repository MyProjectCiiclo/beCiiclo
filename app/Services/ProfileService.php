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
        $profile = $this->profileRepository->getProfile();

        return [
            ...$profile->toArray(),
            'total_skills' => $profile->skills->count(),
        ];
    }

    public function updateProfile($data)
    {
        return $this->profileRepository->updateProfile($data);
    }
}
