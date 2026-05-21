<?php

namespace App\Http\Controllers;

use App\Services\EducationService;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    protected $educationService;

    public function __construct(EducationService $educationService)
    {
        $this->educationService = $educationService;
    }

    public function index()
    {
        return response()->json($this->educationService->getAll());
    }

    public function store(Request $request)
    {
        return response()->json(
            $this->educationService->create($request->all())
        );
    }

    public function update($id, Request $request)
    {
        return response()->json(
            $this->educationService->update($id, $request->all())
        );
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'Deleted',
            'data' => $this->educationService->delete($id)
        ]);
    }
}
