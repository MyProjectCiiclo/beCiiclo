<?php

namespace App\Http\Controllers;

use App\Services\ProjectExperiencesService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectExperiencesController extends Controller
{
    protected $projectService;

    public function __construct(ProjectExperiencesService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        return response()->json(
            $this->projectService->getAll()
        );
    }

    public function createProject(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'project_type' => 'required|string|max:255',
        ]);

        $data = $request->only([
            'project_name',
            'language',
            'description',
            'image',
            'project_type'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('projects', $filename, 'public');
            $data['image'] = $path;
        }

        $project = $this->projectService->createProject($data);

        return response()->json([
            'message' => 'Success Create',
            'project' => $project,
        ]);
    }
}