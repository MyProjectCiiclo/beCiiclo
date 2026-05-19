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
                'language' => 'Next.js, TypeScript',
                'description' => 'Personal portfolio website using Next.js and Tailwind CSS',
                'image' => 'https://example.com/portfolio.png',
                'project_type' => 'Frontend',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'project_name' => 'E-Commerce Website',
                'language' => 'Laravel, MySQL',
                'description' => 'Online shopping website with cart and payment',
                'image' => 'https://example.com/ecommerce.png',
                'project_type' => 'Fullstack',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'project_name' => 'Task Management App',
                'language' => 'React, Node.js',
                'description' => 'Application for managing daily tasks',
                'image' => 'https://example.com/task.png',
                'project_type' => 'Backend',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}