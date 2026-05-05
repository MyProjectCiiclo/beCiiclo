<?php

namespace App\Repository;

use App\Models\WorkExperienceModel;

class WorkExperienceRepository 
{
    protected $workExperienceModel;

    public function __construct(WorkExperienceModel $workExperienceModel)
    {
        $this->workExperienceModel = $workExperienceModel;
    }

    public function getAllWorkExperiences()
    {
        return $this->workExperienceModel->all();
    }
}