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

    public function getAll($perPage)
    {
        return $this->ProjectExperiencesModel
            ->paginate($perPage);
    }

    public function createProject(array $data)
    {
        if (empty($data['project_name'])) {
            throw new \Exception("Project name is required");
        }

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

        if (! $project) {
            return false;
        }

        return $project->delete();
    }
}
