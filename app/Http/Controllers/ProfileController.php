<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;
    protected $cloudinaryService;

    public function __construct(
        ProfileService $profileService,
        CloudinaryService $cloudinaryService
    ) {
        $this->profileService = $profileService;
        $this->cloudinaryService = $cloudinaryService;
    }

    public function index()
    {
        $profile = $this->profileService->getProfile();

        return response()->json([
            'message' => 'success',
            'data' => $profile
        ]);
    }

    public function updateProfile(Request $request)
    {
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
            'cv_url'
        ]);

        if ($request->hasFile('avatar')) {

            $avatarUrl = $this
                ->cloudinaryService
                ->upload($request->file('avatar'));

            $data['avatar'] = $avatarUrl;
        }

        $data = array_filter($data);

        if (empty($data)) {
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