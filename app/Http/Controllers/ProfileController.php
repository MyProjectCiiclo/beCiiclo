<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index()
    {
        $profile = $this->profileService->getProfile();

        return response()->json([
            'message' => 'success',
            'data' => $profile
        ]);
    }

    public function updateProfile(Request $request) {
         $data = $request->only([
            'full_name',
            'title',
            'description',
            'email',
            'phone',
            'location',
            'github',
            'linkedin',
            'website',
            'avatar',
            'cv_url'
        ]);

        $data = array_filter($data);

        if(empty($data)){
            return response()->json([
                'message' => 'Please enter data to update'
            ], 422);
        }

        $profile = $this->profileService->updateProfile($data);

        return response()->json([
            'message' => 'success',
            'data' => $profile
        ]);
    }
}
