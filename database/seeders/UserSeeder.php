<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create multiple users for testing
        User::factory(10)->create();

        // Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone_number' => '123456789',
            'address' => '123 Admin Street, City, Country',
            'profile_picture' => null,
            'status' => 'active',
        ]);

        // Staff User
        User::factory()->create([
            'name' => 'Staff Member',
            'email' => 'staff@example.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
            'phone_number' => '987654321',
            'address' => '456 Staff Avenue, City, Country',
            'profile_picture' => null,
            'status' => 'active',
        ]);

        // Client User
        User::factory()->create([
            'name' => 'Test Client',
            'email' => 'client@example.com',
            'password' => Hash::make('password123'),
            'role' => 'client',
            'phone_number' => '555666777',
            'address' => '789 Client Road, City, Country',
            'profile_picture' => null,
            'status' => 'active',
        ]);
    }
}