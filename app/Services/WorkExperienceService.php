<?php

namespace App\Services;

use App\Repository\WorkExperienceRepository;

class WorkExperienceService
{
    protected $workExperienceRepository;
    public function __construct(WorkExperienceRepository $workExperienceRepository)
    {
        $this->workExperienceRepository = $workExperienceRepository;
    }
    public function getAllWorkExperiences()
    {
        $data = $this->workExperienceRepository->getAllWorkExperiences();

        return $data->groupBy('years')->map(function ($items, $year) {
            return [
                'year' => $year,
                'total' => $items->count(),
                'work_experiences' => $items
            ];
        })->values();
    }
}
