<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hairstyle;

class HairstyleSeeder extends Seeder
{
    public function run()
    {
        Hairstyle::insert([
            [
                'name' => 'Box Braids',
                'description' => 'Classic protective hairstyle with individual braided sections.',
                'duration' => 180,
                'price' => 120.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cornrows',
                'description' => 'Neat, tight braids close to the scalp.',
                'duration' => 120,
                'price' => 90.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
