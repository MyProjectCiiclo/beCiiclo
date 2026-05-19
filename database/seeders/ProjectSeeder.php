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
                'project_name' => 'Portfolio Website',
                'description' => 'Personal portfolio website using Next.js and Tailwind CSS',
                'language' => 'Next.js',
                'image_url' => 'https://example.com/portfolio.png',
                'project_type' => 'Frontend',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_name' => 'E-Commerce Website',
                'description' => 'Online shopping website with cart and payment',
                'language' => 'Laravel, MySQL',
                'image_url' => 'https://example.com/ecommerce.png',
                'project_type' => 'Fullstack',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_name' => 'Task Management App',
                'description' => 'Application for managing daily tasks',
                'language' => 'React, Node.js',
                'image_url' => 'https://example.com/task.png',
                'project_type' => 'Backend',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}