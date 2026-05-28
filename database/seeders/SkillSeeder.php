<?php

namespace Database\Seeders;

use App\Models\SkillModel;
use App\Models\ProfileModel;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $profile = ProfileModel::first(); // hoặc find(1)

        $skills = [
            [
                'name' => 'React & Next.js',
                'image' => 'https://cdn.jsdelivr.net/...',
                'weight' => 5,
            ],
            [
                'name' => 'Node.js & Express',
                'image' => 'https://cdn.jsdelivr.net/...',
                'weight' => 4,
            ],
        ];

        foreach ($skills as $skill) {
            SkillModel::create([
                'profile_id' => $profile->id,
                'name' => $skill['name'],
                'image' => $skill['image'],
                'weight' => $skill['weight'],
                'color' => $this->generateColor($skill['name']),
            ]);
        }
    }

    private function generateColor($name)
    {
        $colors = [
            '#f472b6', '#ec4899', '#fb7185',
            '#a78bfa', '#60a5fa', '#34d399',
        ];

        return $colors[crc32($name) % count($colors)];
    }
}