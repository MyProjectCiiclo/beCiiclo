<?php

namespace App\Http\Controllers;

use App\Services\IntroService;

class IntroController extends Controller
{
    protected $introService;

    public function __construct(IntroService $introService)
    {
        $this->introService = $introService;
    }

    public function getIntro()
    {
        $data = $this->introService->getIntros();

        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }
}