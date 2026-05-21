<?php

namespace Database\Seeders;

use App\Models\CourseModel;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        CourseModel::create([
            'education_id' => 1,
            'name' => 'Web Development'
        ]);

        CourseModel::create([
            'education_id' => 1,
            'name' => 'UI/UX Design'
        ]);

        CourseModel::create([
            'education_id' => 1,
            'name' => 'Agile Scrum'
        ]);

        CourseModel::create([
            'education_id' => 2,
            'name' => 'Mathematics'
        ]);

        CourseModel::create([
            'education_id' => 2,
            'name' => 'Physics'
        ]);
    }
}