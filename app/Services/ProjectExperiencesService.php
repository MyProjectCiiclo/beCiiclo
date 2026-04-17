<?php

namespace App\Services;

use App\Repository\ProjectExperiencesRepository;
use App\Repository\ProjectRepository;

class ProjectExperiencesService {

    protected $projectRepository;

    public function __construct(ProjectExperiencesRepository $projectRepository) {
        $this->projectRepository = $projectRepository;
    }

    public function getAll(){
        return $this->projectRepository->getAll();
    }

    public function createProject(array $data){
        return $this->projectRepository->createProject($data);
    }

}
