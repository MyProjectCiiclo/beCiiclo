<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactModel;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        ContactModel::create([
            'name' => 'Test User 1',
            'email' => 'test1@gmail.com',
            'message' => 'Hello admin!'
        ]);

        ContactModel::create([
            'name' => 'Test User 2',
            'email' => 'test2@gmail.com',
            'message' => 'I want to contact you'
        ]);
    }
}