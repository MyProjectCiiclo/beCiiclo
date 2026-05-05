<?php

namespace Database\Seeders;

use App\Models\ProfileModel;
use App\Models\SkillModel;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $profile = ProfileModel::create([
            'full_name' => 'Jordan Mitchell',
            'title' => 'Full Stack Developer',
            'description' => 'I specialize in creating scalable, user-friendly web applications.',
            'projects' => 156,
            'years' => '2+',
            'clients' => 42,
            'experience_years' => '7+ Years',
            'degree' => 'Master of Science',
            'website' => 'portfolio.com',
            'email' => 'contact@example.com',
            'github' => 'github.com/jordanmitchell',
            'linkedin' => 'linkedin.com/in/jordanmitchell',
            'avatar' => 'image-personal.png',
            'cv_url' => 'cv.pdf',
        ]);

        $skills = [
            [
                'name' => 'React & Next.js',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg',
                'percent' => 95,
            ],
            [
                'name' => 'Node.js & Express',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg',
                'percent' => 90,
            ],
            [
                'name' => 'UI/UX Design',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg',
                'percent' => 85,
            ],
            [
                'name' => 'MongoDB & PostgreSQL',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg',
                'percent' => 80,
            ],
            [
                'name' => 'Docker & AWS',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg',
                'percent' => 75,
            ],
        ];

        foreach ($skills as $skill) {
            SkillModel::create([
                'profile_id' => $profile->id,
                'name' => $skill['name'],
                'icon' => $skill['icon'],
                'percent' => $skill['percent'],
            ]);
        }
    }
}