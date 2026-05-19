<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuthModel;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        AuthModel::updateOrCreate(
            [
                'email' => 'hokimthanh1234@gmail.com'
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('coganglennao12'),
                'role' => 'admin',
            ]
        );
    }
}
