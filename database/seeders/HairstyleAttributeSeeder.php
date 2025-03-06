<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HairstyleAttribute;

class HairstyleAttributeSeeder extends Seeder
{
    public function run()
    {
        HairstyleAttribute::insert([
            ['name' => 'Texture', 'category' => 'Texture', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Length', 'category' => 'Length', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Color', 'category' => 'Color', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
