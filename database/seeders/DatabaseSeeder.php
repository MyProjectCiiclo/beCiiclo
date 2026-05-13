<?php

namespace Database\Seeders;

use App\Models\User;
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
            ProjectExperiencesSeeder::class,
            ProfileSeeder::class,
            WorkExperienceSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
