<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('project_experiences')->insert([
            [
                'project_name' => 'Portfolio Website',
                'language' => 'VueJS',
                'description' => 'Personal portfolio project',
                'image' => null,
                'project_type' => 'Frontend',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_name' => 'API Backend',
                'language' => 'Laravel',
                'description' => 'REST API for project management',
                'image' => null,
                'project_type' => 'Backend',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_name' => 'E-commerce UI',
                'language' => 'Vue + Tailwind',
                'description' => 'UI for shopping website',
                'image' => null,
                'project_type' => 'UI/UX',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
