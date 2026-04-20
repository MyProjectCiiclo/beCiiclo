<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Services\CloudinaryService;
use App\Services\ProjectExperiencesService;

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

    public function createProject(StoreProjectRequest $request)
    {
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
    public function updateProject(UpdateProjectRequest $request, int $id)
    {
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

    public function destroy (int $id){
        $delete = $this->projectService->deleteProject($id);

        if(!$delete){
            return response()->json([
                'message' => 'Project not found',
            ],404);
        }
        return response()->json([
            'message' => 'Success Delete',
        ],204);
    }
}
