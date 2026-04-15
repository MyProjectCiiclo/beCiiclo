<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function getProject(){
        $data = $this->projectService->getProjects();

        return response()->json([
            'message' => 'success',
            'data' => $data, 
        ]);


    }
}
