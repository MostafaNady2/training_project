<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create or update users if they don't exist
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'employer@example.com'],
            [
                'name' => 'Employer User',
                'password' => Hash::make('password123'),
                'role' => 'employer',
            ]
        );

        User::firstOrCreate(
            ['email' => 'candidate@example.com'],
            [
                'name' => 'Candidate User',
                'password' => Hash::make('password123'),
                'role' => 'candidate',
            ]
        );

        // Call JobSeeder
        $this->call([
            JobSeeder::class,
        ]);
    }
}