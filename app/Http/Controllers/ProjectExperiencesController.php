<?php

namespace App\Http\Controllers;

use App\Services\ProjectExperiencesService;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class ProjectExperiencesController extends Controller
{
    protected $projectService;
    protected $cloudinary;

    public function __construct(
        ProjectExperiencesService $projectService,
        CloudinaryService $cloudinary
    ) {
        $this->projectService = $projectService;
        $this->cloudinary = $cloudinary;
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
            'project_type'
        ]);

        if ($request->hasFile('image')) {
            try {
                $data['image'] = $this->cloudinary->upload($request->file('image'));
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Upload failed',
                    'detail' => $e->getMessage()
                ], 500);
            }
        }

        $project = $this->projectService->createProject($data);

        return response()->json([
            'message' => 'Success Create',
            'project' => $project,
        ]);
    }

    public function updateProject(Request $request, int $id)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'project_type' => 'required|string|max:25',
        ]);

        $data = $request->only([
            'project_name',
            'language',
            'description',
            'project_type',
        ]);

        if ($request->hasFile('image')) {
            try {
                $data['image'] = $this->cloudinary->upload($request->file('image'));
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Upload failed',
                    'detail' => $e->getMessage()
                ], 500);
            }
        }

        $project = $this->projectService->updateProject($id, $data);

        return response()->json([
            'message' => 'Success Update',
            'project' => $project,
        ]);
    }
}