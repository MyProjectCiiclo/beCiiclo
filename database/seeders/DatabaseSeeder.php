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
            IntroSeeder::class,
            AboutSeeder::class,
            ProfileSeeder::class,
            WorkExperienceSeeder::class,
            AdminSeeder::class,
            ContactSeeder::class,
            ProjectSeeder::class,
            UserSeeder::class,
            CvSeeder::class,
            EducationSeeder::class,
            CourseSeeder::class,
            RatingSeeder::class,
            SkillSeeder::class,
        ]);
    }
}
