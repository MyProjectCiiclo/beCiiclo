<?php

namespace App\Http\Controllers;

use App\Services\AboutService;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $aboutService;

    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }

    public function getAbout()
    {
        $data = $this->aboutService->getAbouts();

        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }
}
