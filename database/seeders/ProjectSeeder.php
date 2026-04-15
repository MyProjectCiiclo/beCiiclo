<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'title' => 'Project 1',
                'description' => 'Demo project',
                'image_url' => null,
                'tags' => json_encode(['Vue', 'Tailwind']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Project 2',
                'description' => 'Another project',
                'image_url' => null,
                'tags' => json_encode(['React']),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
