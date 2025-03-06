<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BookingAttributeValueSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            HairstyleSeeder::class,
            HairstyleAttributeSeeder::class,
            HairstyleAttributeValueSeeder::class,
            HairstyleImageSeeder::class,
            AttributePricingSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
