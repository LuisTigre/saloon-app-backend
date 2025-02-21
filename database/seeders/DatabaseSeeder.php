<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BraidingStyleSeeder::class,
            BookingSeeder::class,
            StyleAttributeSeeder::class,
            StyleAttributeValueSeeder::class,
            StyleImageSeeder::class,
            BookingStyleAttributeValueSeeder::class, // Run this seeder after bookings and attribute values exist
        ]);
    }
}
