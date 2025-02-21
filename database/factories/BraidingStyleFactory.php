<?php

namespace Database\Factories;

use App\Models\BraidingStyle;
use Illuminate\Database\Eloquent\Factories\Factory;

class BraidingStyleFactory extends Factory
{
    protected $model = BraidingStyle::class;

    public function definition()
    {
        return [
            'style_name'  => $this->faker->word,
            'description' => $this->faker->sentence,
            'duration'    => $this->faker->numberBetween(30, 180),
            'price'       => $this->faker->randomFloat(2, 50, 300),
        ];
    }
}
