<?php

namespace Database\Seeders;

use App\Models\RatingModel;
use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        RatingModel::create([
            'name' => 'Nguyen Van A',
            'message' => 'Very good developer and UI designer.',
            'rating' => 5,
        ]);

        RatingModel::create([
            'name' => 'Tran Thi B',
            'message' => 'Worked very professionally.',
            'rating' => 4,
        ]);

        RatingModel::create([
            'name' => 'Le Van C',
            'message' => 'Excellent teamwork and communication.',
            'rating' => 5,
        ]);
    }
}