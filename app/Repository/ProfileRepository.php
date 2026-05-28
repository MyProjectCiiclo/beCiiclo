<?php

namespace App\Repository;

use App\Models\ProfileModel;
use Illuminate\Support\Facades\Auth;

class ProfileRepository
{
    protected $profileModel;

    public function __construct(ProfileModel $profileModel)
    {
        $this->profileModel = $profileModel;
    }

    public function getProfile()
    {
        return $this->profileModel
            ->with(['skills'])
            ->first();
    }

    public function updateProfile(array $data)
    {
        $user = Auth::user();

        if (!$user) {
            throw new \Exception('Unauthenticated user');
        }

        $profile = ProfileModel::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $profile->fill($data);
        $profile->save();

        return $profile->load(['skills']);
    }
}
