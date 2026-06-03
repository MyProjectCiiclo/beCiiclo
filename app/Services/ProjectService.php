<?php

namespace App\Services;

use App\Repository\ProjectExperiencesRepository;
use App\Repository\ProjectRepository;

class ProjectService
{

    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAll($perpage)
    {
        return $this->projectRepository->getAll($perpage);
    }
    public function createProject($data)
    {
        return $this->projectRepository->createProject($data);
    }

    public function updateProject($id, $data)
    {
        return $this->projectRepository->updateProject($id, $data);
    }

    public function deleteProject($id)
    {
        return $this->projectRepository->deleteProject($id);
    }
}
