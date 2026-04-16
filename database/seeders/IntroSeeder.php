<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntroSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('intros')->insert([
            'image_url' => 'https://cdn.vietnambiz.vn/2020/3/24/project-planning-header2x-1585044567657817815413.png',
            'description' => 'I craft beautiful, accessible interfaces...',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}