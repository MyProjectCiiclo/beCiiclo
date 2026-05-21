<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function store(Request $request)
    {
        return response()->json(
            $this->courseService->create($request->all())
        );
    }

    public function update($id, Request $request)
    {
        return response()->json(
            $this->courseService->update($id, $request->all())
        );
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'Deleted',
            'data' => $this->courseService->delete($id)
        ]);
    }
}
