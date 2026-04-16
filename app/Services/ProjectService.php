<?php

namespace App\Services;

use App\Repository\ProjectRepository;


class ProjectService {

    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository) {
        $this->projectRepository = $projectRepository;
    }

    public function getAll(){
        return $this->projectRepository->getAll();
    }

    public function createProject(array $data){
        return $this->projectRepository->createProject($data);
    }

}