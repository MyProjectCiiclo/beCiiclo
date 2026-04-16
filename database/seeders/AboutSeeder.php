<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('abouts')->insert([
            'design_description' => 'With a focus on user-centered design...',
            'dev_description' => 'I build performant, scalable applications...',
            'design_items' => json_encode([
                'Responsive design',
                'Accessibility (WCAG)',
                'Design systems'
            ]),
            'skills' => json_encode([
                'Vue',
                'Tailwind',
                'TypeScript',
                'API'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
