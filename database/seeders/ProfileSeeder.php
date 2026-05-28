<?php

namespace Database\Seeders;

use App\Models\ProfileModel;
use App\Models\ProfileStats;
use App\Models\AuthModel;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $user = AuthModel::first();

        $profile = ProfileModel::create([
            'user_id' => $user->id,

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
    }
}