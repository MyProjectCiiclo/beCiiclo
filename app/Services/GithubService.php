<?php

namespace App\Services;

use App\Repository\GithubRepository;

class GithubService
{
    protected $repo;

    public function __construct(GithubRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getContributions($username)
    {
        $data = $this->repo->fetchContributions($username);

        if (!isset($data['data']['user'])) {
            return null;
        }

        return [
            'total' => $data['data']['user']['contributionsCollection']['contributionCalendar']['totalContributions'],
            'weeks' => $data['data']['user']['contributionsCollection']['contributionCalendar']['weeks']
        ];
    }
}