<?php

namespace Database\Seeders;

use App\Models\EducationModel;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        EducationModel::create([
            'user_id' => 1,
            'school' => 'PNV College',
            'degree' => 'Bachelor',
            'major' => 'Software Engineering',
            'start_date' => '2023-01-01',
            'end_date' => null,
            'description' => 'Focus on Frontend, Backend and Fullstack development.'
        ]);

        EducationModel::create([
            'user_id' => 1,
            'school' => 'High School ABC',
            'degree' => 'High School',
            'major' => 'Natural Science',
            'start_date' => '2019-01-01',
            'end_date' => '2022-01-01',
            'description' => 'Basic foundation of Mathematics and Physics.'
        ]);
    }
}
