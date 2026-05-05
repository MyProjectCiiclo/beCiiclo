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

        return $response->json();
    }
}