<?php

namespace Database\Seeders;

use App\Models\ProfileModel;
use App\Models\ProfileStats;
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

            'email' => 'hokimthanh1234@gmail.com',
            'phone' => '+84 335 044 593',
            'location' => 'Da Nang, Vietnam',

            'github' => 'github.com/KimThanh1801',
            'linkedin' => 'linkedin.com/in/ho-thi-kim-thanh/',
            'website' => 'portfolio.com',

            'avatar' => 'image-personal.png',
            'cv_url' => 'cv.pdf',
        ]);

        ProfileStats::create([
            'profile_id' => $profile->id,
            'projects' => 156,
            'clients' => 42,
            'years' => '2+',
            'experience_years' => '7+ Years',
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