<?php

namespace App\Repository;

use Illuminate\Support\Facades\Http;

class GithubRepository
{
    public function fetchContributions($username)
    {
        $token = env('GITHUB_TOKEN');

        $query = '
        query {
          user(login: "' . $username . '") {
            contributionsCollection {
              contributionCalendar {
                totalContributions
                weeks {
                  contributionDays {
                    date
                    contributionCount
                    color
                  }
                }
              }
            }
          }
        }';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/vnd.github+json'
        ])->post('https://api.github.com/graphql', [
            'query' => $query
        ]);

        $data = $response->json();

        return $data['data']['user']['contributionsCollection']['contributionCalendar'] ?? [
            'totalContributions' => 0,
            'weeks' => []
        ];
    }

    public function getUser($username)
    {
        return Http::get("https://api.github.com/users/$username")->json();
    }
}
