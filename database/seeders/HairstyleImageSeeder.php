<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HairstyleImage;

class HairstyleImageSeeder extends Seeder
{
    public function run()
    {
        HairstyleImage::insert([
            ['hairstyle_id' => 1, 'image_url' => 'images/box_braids.jpg', 'is_main_image' => true, 'created_at' => now(), 'updated_at' => now()],
            ['hairstyle_id' => 2, 'image_url' => 'images/cornrows.jpg', 'is_main_image' => true, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
