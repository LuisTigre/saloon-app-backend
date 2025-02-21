<?php

namespace Database\Factories;

use App\Models\StyleAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class StyleAttributeFactory extends Factory
{
    protected $model = StyleAttribute::class;

    public function definition()
    {
        return [
            'attribute_name' => $this->faker->word,
        ];
    }
}
