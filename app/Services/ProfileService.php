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
        $profile = $this->profileRepository->updateProfile($data);

        if ($profile && $profile->user) {
            $profile->user->update([
                'name' => $data['full_name'] ?? $profile->user->name,
            ]);
        }

        return $profile->load('user');
    }
}
