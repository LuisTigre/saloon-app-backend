<?php

namespace Database\Factories;

use App\Models\StyleImage;
use App\Models\BraidingStyle;
use Illuminate\Database\Eloquent\Factories\Factory;

class StyleImageFactory extends Factory
{
    protected $model = StyleImage::class;

    public function definition()
    {
        return [
            'style_id'      => BraidingStyle::inRandomOrder()->first()->id ?? BraidingStyle::factory(),
            'image_url'     => $this->faker->imageUrl(640, 480, 'abstract', true),
            'is_main_image' => $this->faker->boolean(),
        ];
    }
}


