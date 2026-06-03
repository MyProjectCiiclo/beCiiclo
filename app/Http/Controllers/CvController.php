<?php

namespace App\Http\Controllers;

use App\Http\Requests\CvRequest;
use App\Services\CvService;

class CvController extends Controller
{
    protected $cvService;

    public function __construct(CvService $cvService)
    {
        $this->cvService = $cvService;
    }

    public function index()
    {
        $data = $this->cvService->getAllCv();

        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }

    public function uploadCv(CvRequest $request)
    {
        $data = $this->cvService->uploadCv(
            $request->file('cv')
        );

        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }

    public function updateCv($id, CvRequest $request)
    {
        $data = $this->cvService->updateCv(
            $id,
            $request->file('cv')
        );

        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }

    public function destroy($id)
    {
        $this->cvService->deleteCv($id);

        return response()->json([
            'message' => 'success',
        ]);
    }
}
