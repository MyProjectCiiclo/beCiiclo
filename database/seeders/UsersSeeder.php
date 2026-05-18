<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Kim Thanh',
            'email' => 'hokimthanh1234@gmail.com',
            'password' => Hash::make('coganglennao12'),
        ]);
    }
}