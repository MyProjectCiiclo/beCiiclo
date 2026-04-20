<?php

namespace App\Http\Controllers;

use App\Services\ProjectExperiencesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            'project_type'
        ]);

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $response = Http::attach(
                'file',
                file_get_contents($file),
                $file->getClientOriginalName()
            )->post('https://api.cloudinary.com/v1_1/droybexbj/image/upload', [
                'upload_preset' => 'my_preset'
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'error' => 'Upload failed',
                    'detail' => $response->body()
                ], 500);
            }

            $result = $response->json();

            $data['image'] = $result['secure_url'] ?? null;
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

            $file = $request->file('image');

            $response = Http::attach(
                'file',
                file_get_contents($file),
                $file->getClientOriginalName()
            )->post('https://api.cloudinary.com/v1_1/droybexbj/image/upload', [
                'upload_preset' => 'my_preset'
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'error' => 'Upload failed',
                    'detail' => $response->body()
                ], 500);
            }

            $result = $response->json();

            $data['image'] = $result['secure_url'] ?? null;
        }

        $project = $this->projectService->updateProject($id, $data);

        return response()->json([
            'message' => 'Success Update',
            'project' => $project,
        ]);
    }
}
