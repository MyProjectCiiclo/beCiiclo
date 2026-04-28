<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Services\CloudinaryService;
use App\Services\ProjectExperiencesService;
use Illuminate\Support\Facades\Log;
use Throwable;

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
            Log::info('GET PROJECTS START');

            $perPage = (int) request()->get('per_page', 10);

            $data = $this->projectService->getAll($perPage);

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
        } catch (Throwable $e) {
            Log::error('INDEX ERROR', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ], 500);
        }
    }

    public function createProject(StoreProjectRequest $request)
    {
        try {
            $data = $request->only([
                'project_name',
                'language',
                'description',
                'project_type'
            ]);

            if ($request->hasFile('image')) {
                $data['image'] = $this->cloudinary->upload(
                    $request->file('image')
                );
            }

            $project = $this->projectService->createProject($data);

            return response()->json([
                'message' => 'success',
                'project' => $project,
            ], 201);

        } catch (Throwable $e) {
            Log::error('CREATE ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function updateProject(UpdateProjectRequest $request, int $id)
    {
        try {
            $data = $request->only([
                'project_name',
                'language',
                'description',
                'project_type',
            ]);

            if ($request->hasFile('image')) {
                $data['image'] = $this->cloudinary->upload(
                    $request->file('image')
                );
            }

            $project = $this->projectService->updateProject($id, $data);

            return response()->json([
                'message' => 'success',
                'project' => $project,
            ]);

        } catch (Throwable $e) {
            Log::error('UPDATE ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $delete = $this->projectService->deleteProject($id);

            if (!$delete) {
                return response()->json([
                    'message' => 'Project not found'
                ], 404);
            }

            return response()->json([
                'message' => 'success'
            ]);

        } catch (Throwable $e) {
            Log::error('DELETE ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }
}