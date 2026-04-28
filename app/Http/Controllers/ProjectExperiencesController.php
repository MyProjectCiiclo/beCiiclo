<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Services\CloudinaryService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

            /** @var LengthAwarePaginator $data */
            $data = $this->projectService->getAll($perPage); // Assuming getAll returns a Paginator instance

            return response()->json([
                'message' => 'success',
                'data' => $data->items(),
                'meta' => [
                    'current_page' => $data->currentPage(),
                    'last_page'    => $data->lastPage(),
                    'per_page'     => $data->perPage(),
                    'total'        => $data->total(),
                ]
            ]);
        } catch (\Exception $e) {
            // Log the full error for server-side debugging
            Log::error('Get Project Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Conditional error response based on APP_DEBUG
            return response()->json([
                'message' => config('app.debug') ? $e->getMessage() : 'Server Error',
                'trace' => config('app.debug') ? $e->getTraceAsString() : null,
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
                try {
                    $data['image'] = $this->cloudinary->upload($request->file('image'));
                } catch (\Exception $e) {
                    Log::error('UPLOAD ERROR during create', [
                        'message' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    return response()->json([
                        'message' => 'Failed to upload image',
                        'error' => config('app.debug') ? $e->getMessage() : 'Image upload failed',
                    ], 500);
                }
            }

            $project = $this->projectService->createProject($data);

            Log::info('Project created successfully', [
                'project_id' => $project->id ?? null
            ]);

            return response()->json([
                'message' => 'Success Create',
                'project' => $project,
            ], 201);
        } catch (\Exception $e) {
            Log::error('CREATE PROJECT ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Failed to create project',
                'error' => config('app.debug') ? $e->getMessage() : 'Server Error',
                'trace' => config('app.debug') ? $e->getTraceAsString() : null,
            ], 500);
        }
    }
    public function updateProject(UpdateProjectRequest $request, int $id)
    {
        try {
            Log::info('Update Project Request', ['id' => $id, 'data' => $request->all()]);

            $data = $request->only([
                'project_name',
                'language',
                'description',
                'project_type',
            ]);

            if ($request->hasFile('image')) {
                try {
                    $data['image'] = $this->cloudinary->upload($request->file('image'));
                } catch (\Exception $e) { // Catch specific upload errors
                    Log::error('UPLOAD ERROR', [
                        'message' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);

                    return response()->json([
                        'error' => 'Upload failed',
                        'detail' => config('app.debug') ? $e->getMessage() : 'Image upload failed',
                        'trace' => config('app.debug') ? $e->getTraceAsString() : null,
                    ], 500);
                }
            }

            $project = $this->projectService->updateProject($id, $data);

            Log::info('Project updated successfully', [
                'project_id' => $project->id ?? null
            ]);

            return response()->json([
                'message' => 'Success Update',
                'project' => $project,
            ]);
        } catch (\Exception $e) {
            Log::error('UPDATE PROJECT ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Failed to update project',
                'error' => config('app.debug') ? $e->getMessage() : 'Server Error',
                'trace' => config('app.debug') ? $e->getTraceAsString() : null,
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $delete = $this->projectService->deleteProject($id);

            if (!$delete) {
                return response()->json([
                    'message' => 'Project not found',
                ], 404);
            }
            return response()->json([
                'message' => 'Success Delete',
            ]);
        } catch (\Exception $e) {
            Log::error('DELETE PROJECT ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Failed to delete project',
                'error' => config('app.debug') ? $e->getMessage() : 'Server Error',
                'trace' => config('app.debug') ? $e->getTraceAsString() : null,
            ], 500);
        }
    }
}
