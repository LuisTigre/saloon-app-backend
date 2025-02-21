<?php

namespace Database\Factories;

use App\Models\StyleAttributeValue;
use App\Models\BraidingStyle;
use App\Models\StyleAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class StyleAttributeValueFactory extends Factory
{
    protected $model = StyleAttributeValue::class;

    public function definition()
    {
        return [
            'style_id'     => BraidingStyle::factory(),
            'attribute_id' => StyleAttribute::factory(),
            'value'        => $this->faker->word,
        ];
    }
}
