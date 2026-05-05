<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Services\GithubService;

class GithubController extends Controller
{
    protected $githubService;

    public function __construct(GithubService $githubService)
    {
        $this->githubService = $githubService;
    }

    public function getContributions()
    {
        $result = $this->githubService->getContributions("KimThanh1801");

        return response()->json($result);
    }

    public function getUser()
    {
        $result = $this->githubService->getUser("KimThanh1801");

        return response()->json($result);
    }
}