<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StyleImage;

class StyleImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        StyleImage::factory()->count(10)->create();
    }
}