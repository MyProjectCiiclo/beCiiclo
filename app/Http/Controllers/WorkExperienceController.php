<?php

namespace App\Http\Controllers;

use App\Services\WorkExperienceService;

class WorkExperienceController extends Controller
{
    protected $workExperienceService;

    public function __construct(WorkExperienceService $workExperienceService)
    {
        $this->workExperienceService = $workExperienceService;
    }

    public function index()
    {
        $data = $this->workExperienceService->getAllWorkExperiences();

        return response()->json([
            'status' => 'ok',
            'data' => $data
        ]);
    }
}