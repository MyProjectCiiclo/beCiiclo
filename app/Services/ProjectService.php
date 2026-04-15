<?php

namespace App\Services;

use App\Repository\ProjectRepository;

class ProjectService{
    protected $projectRepository;


    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getProjects()
{
    return $this->projectRepository->getProjects();

}}