<?php
namespace App\Repository;

use App\Models\ProjectModel;


class ProjectRepository{

    protected $projectModel;

    public function __construct(ProjectModel $projectModel){
        $this->projectModel = $projectModel;
    }

    public function getAll(){
        return $this->projectModel->all();
    }

    public function createProject(array $data){
        return $this->projectModel->create($data);
    }
}