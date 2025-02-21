<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StyleAttribute;

class StyleAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['attribute_name' => 'Color'],
            ['attribute_name' => 'Length'],
            ['attribute_name' => 'Texture'],
        ];

        foreach ($attributes as $attribute) {
            StyleAttribute::create($attribute);
        }
    }
}