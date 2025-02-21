<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StyleAttributeValue;
use App\Models\BraidingStyle;
use App\Models\StyleAttribute;
use Illuminate\Support\Str;

class StyleAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get available ids
        $styleIds = BraidingStyle::pluck('id');
        $attributeIds = StyleAttribute::pluck('id');

        // Create 10 attribute values with valid foreign keys
        StyleAttributeValue::factory()->count(10)->make()->each(function ($value) use ($styleIds, $attributeIds) {
            $value->style_id = $styleIds->random();
            $value->attribute_id = $attributeIds->random();
            // Set a default value for the "value" attribute
            $value->value = 'Default Value ' . rand(1, 100); // Or use any logic to generate a value
            $value->save();
        });
    }
}