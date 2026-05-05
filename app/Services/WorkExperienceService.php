<?php 
namespace App\Services;

use App\Repository\WorkExperienceRepository;

class WorkExperienceService{
    protected $workExperienceRepository;
    public function __construct(WorkExperienceRepository $workExperienceRepository){
        $this->workExperienceRepository = $workExperienceRepository;
    }
    public function getAllWorkExperiences(){
        return $this->workExperienceRepository->getAllWorkExperiences();
    }
}