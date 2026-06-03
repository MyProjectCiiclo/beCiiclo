<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CvModel;

class CvSeeder extends Seeder
{
    public function run(): void
    {
        CvModel::create([
            'cv' => 'uploads/cv/sample-cv-1.pdf',
            'user_id' => 1
        ]);

        CvModel::create([
            'cv' => 'uploads/cv/sample-cv-2.pdf',
            'user_id' => 1
        ]);

        CvModel::create([
            'cv' => 'uploads/cv/sample-cv-3.pdf',
            'user_id' => 1
        ]);
    }
}
