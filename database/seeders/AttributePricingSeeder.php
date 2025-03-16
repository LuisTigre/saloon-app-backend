<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AttributePricing;

class AttributePricingSeeder extends Seeder
{
    public function run()
    {
        AttributePricing::insert([
            [
                'hairstyle_id' => 1,
                'hairstyle_attribute_value_id' => 1,
                'hairstyle_image_id' => 1, // Example value for hairstyle_image_id
                'additional_cost' => 10.00,
                'additional_time' => 0.00,
                'cost_type' => 'fixed',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'hairstyle_id' => 2,
                'hairstyle_attribute_value_id' => 2,
                'hairstyle_image_id' => 2, // Example value for hairstyle_image_id
                'additional_cost' => 15.00,
                'additional_time' => 5.00,
                'cost_type' => 'percentage',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Add more seed data as needed
        ]);
    }
}
