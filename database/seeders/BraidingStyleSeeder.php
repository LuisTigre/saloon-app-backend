<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BraidingStyle;

class BraidingStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $styles = [
            [
                'style_name'  => 'Cornrows',
                'description' => 'Tight braid style',
                'duration'    => 60,
                'price'       => 80.00,
            ],
            [
                'style_name'  => 'Box Braids',
                'description' => 'Boxed braid style for long-lasting looks',
                'duration'    => 90,
                'price'       => 120.00,
            ],
            [
                'style_name'  => 'Senegalese Twists',
                'description' => 'Sleek twists with natural look',
                'duration'    => 75,
                'price'       => 100.00,
            ],
        ];

        foreach ($styles as $style) {
            BraidingStyle::create($style);
        }
    }
}