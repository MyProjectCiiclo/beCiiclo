<?php

namespace App\Repository;

use App\Models\ProjectModel;

use Illuminate\Database\Eloquent\Model;
class ProjectRepository{
    protected $projectModel;

    public function __construct(ProjectModel $projectModel)
    {
        $this->projectModel = $projectModel;
    }

    public function getProjects(){
        return $this->projectModel->all();
    
    }
}