<?php

namespace Database\Seeders;

use App\Models\AuthModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        AuthModel::updateOrCreate(
            ['email' => 'hokimthanh1234@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('coganglennao12'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ]
        );
    }
}