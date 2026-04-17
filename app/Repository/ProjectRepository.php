<?php
namespace App\Repository;

use App\Models\ProjectExperiencesModel;
class ProjectRepository{

    protected $projectModel;

    public function __construct(ProjectExperiencesModel $projectModel){
        $this->projectModel = $projectModel;
    }

    public function getAll(){
        return $this->projectModel->all();
    }

    public function createProject(array $data){
        return $this->projectModel->create($data);
    }
}