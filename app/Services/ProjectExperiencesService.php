<?php

namespace App\Services;

use App\Repository\ProjectExperiencesRepository;

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

    public function updateProject(int $id, array $data){
        return $this->projectRepository->updateProject($id, $data);
    }

}
