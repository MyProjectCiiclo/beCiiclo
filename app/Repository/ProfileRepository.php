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
        $user = Auth::user();

        return $this->profileModel
            ->with(['skills'])
            ->where('user_id', $user->id)
            ->first();
    }

    public function updateProfile(array $data)
    {
        $user = Auth::user();

        $profile = ProfileModel::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $profile->fill($data);
        $profile->save();

        return $profile;
    }
}