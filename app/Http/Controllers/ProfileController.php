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
        try {
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
                $file = $request->file('avatar');

                $avatarUrl = $this->cloudinaryService->upload($file);

                $data['avatar'] = $avatarUrl;
            }

            $data = array_filter($data, function ($value) {
                return $value !== null;
            });

            if (count($data) === 0) {
                return response()->json([
                    'message' => 'Please enter data to update'
                ], 422);
            }

            $profile = $this->profileService->updateProfile($data);

            return response()->json([
                'message' => 'success',
                'data' => $profile
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
