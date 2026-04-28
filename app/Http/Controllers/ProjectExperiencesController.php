<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Services\CloudinaryService;
use App\Services\ProjectExperiencesService;
use Illuminate\Support\Facades\Log;

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
        try {
            Log::info('Get Projects');

            $perPage = (int) request()->get('per_page', 10);

            if ($perPage <= 0) {
                $perPage = 10;
            }

            $data = $this->projectService->getAll($perPage);

            return response()->json([
                'message' => 'success',
                'data' => $data->items(),
                'meta' => [
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                ]
            ]);
        } catch (\Exception $e) {

            Log::error('Get Project Error', [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'message' => 'Server Error'
            ], 500);
        }
    }

    public function createProject(StoreProjectRequest $request)
    {
        try {
            Log::info('Create Project Request', $request->all());

            $data = $request->only([
                'project_name',
                'language',
                'description',
                'project_type'
            ]);

            if ($request->hasFile('image')) {
                $data['image'] = $this->cloudinary->upload($request->file('image'));
            }

            $project = $this->projectService->createProject($data);

            Log::info('Project created successfully', [
                'project_id' => $project->id ?? null
            ]);

            return response()->json([
                'message' => 'Success Create',
                'project' => $project,
            ]);
        } catch (\Exception $e) {

            Log::error('CREATE PROJECT ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Server Error'
            ], 500);
        }
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

    public function destroy(int $id)
    {
        $delete = $this->projectService->deleteProject($id);

        if (!$delete) {
            return response()->json([
                'message' => 'Project not found',
            ], 404);
        }
        return response()->json([
            'message' => 'Success Delete',
        ], 204);
    }
}
