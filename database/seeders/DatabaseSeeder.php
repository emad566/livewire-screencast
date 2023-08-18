<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'email' => 'emade09@gmail.com',
            'email_verified_at' => now(),
            'name' => 'emade09',
            'password' => '123123',
        ]);
    }
}
