<?php

namespace App\Repository;

use App\Models\ProjectModel;

class ProjectRepository
{

    protected $projectModel;

    public function __construct(ProjectModel $projectModel)
    {
        $this->projectModel = $projectModel;
    }

    public function getAll($perpage)
    {
        return $this->projectModel->query()->paginate($perpage);
    }

    public function createProject($data)
    {
        return $this->projectModel->create($data);
    }

    public function updateProject($id, $data)
    {
        return $this->projectModel->where('id', $id)->update($data);
    }

    public function deleteProject($id){
        return $this->projectModel->where('id', $id)->delete();
    }
}
