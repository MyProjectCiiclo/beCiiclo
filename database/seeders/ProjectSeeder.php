<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'title' => 'Portfolio Website',
                'description' => 'Personal portfolio website using Next.js and Tailwind CSS',
                'image_url' => 'https://example.com/portfolio.png',
                'tags' => json_encode(['Next.js', 'Tailwind', 'TypeScript']),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'E-Commerce Website',
                'description' => 'Online shopping website with cart and payment',
                'image_url' => 'https://example.com/ecommerce.png',
                'tags' => json_encode(['Laravel', 'MySQL', 'Bootstrap']),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Task Management App',
                'description' => 'Application for managing daily tasks',
                'image_url' => 'https://example.com/task.png',
                'tags' => json_encode(['React', 'Node.js', 'MongoDB']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}