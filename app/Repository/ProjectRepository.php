<?php
class ProjectRepository{
    protected $projectModel;

    public function __construct(ProjectModel $projectModel)
    {
        $this->projectModel = $projectModel;
    }
}