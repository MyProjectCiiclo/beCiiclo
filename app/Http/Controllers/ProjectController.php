<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProjectService;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
}
