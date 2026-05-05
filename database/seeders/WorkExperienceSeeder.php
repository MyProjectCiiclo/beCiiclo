<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkExperienceModel;

class WorkExperienceSeeder extends Seeder
{
    public function run(): void
    {
        WorkExperienceModel::insert([
            [
                'title' => 'Full Stack Developer Intern',
                'company' => 'NAB Innovation Centre Vietnam',
                'description' => 'Developed ReactJS enterprise features. Worked with Australian clients.',
                'date_range' => 'Jun 2025 – Aug 2025',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3a/National_Australia_Bank_logo.svg',
                'position' => 1,
            ],
            [
                'title' => 'Full Stack Developer Intern',
                'company' => 'Enosta Group',
                'description' => 'Built UI with React & ExpressJS. Worked on REST APIs.',
                'date_range' => 'Dec 2024 – Jan 2025',
                'logo' => 'https://cdn-icons-png.flaticon.com/512/25/25231.png',
                'position' => 2,
            ],
            [
                'title' => 'Frontend Developer',
                'company' => 'Personal Projects',
                'description' => 'Built VueJS portfolio. Improved UI/UX skills.',
                'date_range' => '2024 – Now',
                'logo' => 'https://cdn-icons-png.flaticon.com/512/25/25231.png',
                'position' => 3,
            ],
        ]);
    }
}