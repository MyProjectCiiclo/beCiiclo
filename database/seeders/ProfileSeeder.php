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
            ['name' => 'React & Next.js', 'percent' => 95],
            ['name' => 'Node.js & Express', 'percent' => 90],
            ['name' => 'UI/UX Design', 'percent' => 85],
            ['name' => 'MongoDB & PostgreSQL', 'percent' => 80],
            ['name' => 'Docker & AWS', 'percent' => 75],
        ];

        foreach ($skills as $skill) {
            SkillModel::create([
                'profile_id' => $profile->id,
                'name' => $skill['name'],
                'percent' => $skill['percent'],
            ]);
        }
    }
}