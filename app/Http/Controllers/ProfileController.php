<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;


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
}