<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AttributePricing;

class AttributePricingSeeder extends Seeder
{
    public function run()
    {
        AttributePricing::insert([
            ['hairstyle_id' => 1, 'hairstyle_attribute_value_id' => 1, 'additional_cost' => 10.00, 'cost_type' => 'fixed', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
