<?php

namespace App\Http\Controllers;

use App\Services\GithubService;

class GithubController extends Controller
{
    protected $service;

    public function __construct(GithubService $service)
    {
        $this->service = $service;
    }

    public function getContributions()
    {
        $username = "KimThanh1801";

        $result = $this->service->getContributions($username);

        if (!$result) {
            return response()->json([
                'error' => 'Cannot fetch GitHub contributions'
            ], 500);
        }

        return response()->json($result);
    }

    public function getUser()
    {
        return response()->json(
            $this->service->getUser("KimThanh1801")
        );
    }
}
