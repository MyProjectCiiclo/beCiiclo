<?php

namespace App\Repository;

use App\Models\ProjectExperiencesModel;

class ProjectExperiencesRepository
{

    protected $ProjectExperiencesModel;

    public function __construct(ProjectExperiencesModel $ProjectExperiencesModel)
    {
        $this->ProjectExperiencesModel = $ProjectExperiencesModel;
    }

    public function getAll()
    {
        return $this->ProjectExperiencesModel->all();
    }

    public function createProject(array $data)
    {
        return $this->ProjectExperiencesModel->create($data);
    }

    public function updateProject(int $id, array $data)
    {
        $project = $this->ProjectExperiencesModel->find($id);

        if (!$project) {
            return null;
        }

        $project->update($data);

        return $project;
    }

    public function deleteProject(int $id)
    {
        $project = $this->ProjectExperiencesModel->find($id);

        if(! $project){
            return false;
        }

        return $project ->delete();
}
}