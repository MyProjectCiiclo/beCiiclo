<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;



    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            IntroSeeder::class,
            AboutSeeder::class,
            WorkExperienceSeeder::class,
            AdminSeeder::class,
            ContactSeeder::class,
            ProjectSeeder::class,
            CvSeeder::class,
            EducationSeeder::class,
            CourseSeeder::class,
            RatingSeeder::class,
            SkillSeeder::class,
        ]);
    }
}
