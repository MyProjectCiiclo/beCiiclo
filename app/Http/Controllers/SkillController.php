<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SkillService;

class SkillController extends Controller
{
    protected $service;

    public function __construct(SkillService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return response()->json([
            'data' => $this->service->getAll()
        ]);
    }

    public function show($id)
    {
        $skill = $this->service->getById($id);

        if (!$skill) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['data' => $skill]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|integer',
            'name' => 'required|string',
            'image' => 'nullable|string',
            'weight' => 'nullable|integer',
            'color' => 'nullable|string',
        ]);

        $skill = $this->service->create($request->all());

        return response()->json([
            'message' => 'Created successfully',
            'data' => $skill
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $skill = $this->service->update($id, $request->all());

        if (!$skill) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'message' => 'Updated successfully',
            'data' => $skill
        ]);
    }

    public function destroy($id)
    {
        $deleted = $this->service->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}