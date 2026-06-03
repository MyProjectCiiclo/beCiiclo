<?php

namespace App\Services;

use App\Repository\GithubRepository;
use Illuminate\Support\Facades\Http;

class GithubService
{
    protected $githubRepository;

    public function __construct(GithubRepository $githubRepository)
    {
        $this->githubRepository = $githubRepository;
    }

    public function getContributions($username)
    {
        $data = $this->githubRepository->fetchContributions($username);

        if (!isset($data['totalContributions'])) {
            return [
                'total' => 0,
                'weeks' => []
            ];
        }

        return [
            'total' => $data['totalContributions'],
            'weeks' => $data['weeks']
        ];
    }
    public function getUser($username)
    {
        return $this->githubRepository->getUser($username);
    }
}
