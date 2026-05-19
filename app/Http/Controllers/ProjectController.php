<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Services\CloudinaryService;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    protected $projectService;
    protected $cloudinary;

    public function __construct(
        ProjectService $projectService,
        CloudinaryService $cloudinary
    ) {
        $this->projectService = $projectService;
        $this->cloudinary = $cloudinary;
    }

    public function index()
    {
        try {
            $perPage = request()->get('per_page', 10);

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
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function createProject(StoreProjectRequest $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $data = $request->only([
                'project_name',
                'language',
                'description',
                'project_type'
            ]);

            $data['user_id'] = Auth::id();

            if ($request->hasFile('image_url')) {
                $data['image_url'] = $this->cloudinary->upload($request->file('image_url'));
            }

            $project = $this->projectService->createProject($data);

            return response()->json([
                'message' => 'success',
                'data' => $project
            ], 201);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'error'], 500);
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

            if ($request->hasFile('image_url')) {
                $data['image_url'] = $this->cloudinary->upload($request->file('image_url'));
            }

            $project = $this->projectService->updateProject($id, $data);

            if (!$project) {
                return response()->json(['message' => 'Not found'], 404);
            }

            return response()->json([
                'message' => 'success',
                'data' => $project
            ]);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'error'], 500);
        }
    }
    public function destroy(int $id)
    {
        try {
            $deleted = $this->projectService->deleteProject($id);

            if (!$deleted) {
                return response()->json(['message' => 'Not found'], 404);
            }
            return response()->json(['message' => 'success']);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'error'], 500);
        }
    }
}
