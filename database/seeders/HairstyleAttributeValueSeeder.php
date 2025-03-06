<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HairstyleAttributeValue;

class HairstyleAttributeValueSeeder extends Seeder
{
    public function run()
    {
        HairstyleAttributeValue::insert([
            ['hairstyle_attribute_id' => 1, 'value' => 'Small', 'created_at' => now(), 'updated_at' => now()],
            ['hairstyle_attribute_id' => 1, 'value' => 'Medium', 'created_at' => now(), 'updated_at' => now()],
            ['hairstyle_attribute_id' => 1, 'value' => 'Large', 'created_at' => now(), 'updated_at' => now()],
            ['hairstyle_attribute_id' => 2, 'value' => 'Shoulder Length', 'created_at' => now(), 'updated_at' => now()],
            ['hairstyle_attribute_id' => 2, 'value' => 'Mid Back', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
