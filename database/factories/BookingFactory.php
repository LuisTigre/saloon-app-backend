<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\BraidingStyle;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'customer_id'      => User::factory(),
            'style_id'         => BraidingStyle::factory(),
            'appointment_date' => $this->faker->date(),
            'start_time'       => $this->faker->time('H:i'),
            'end_time'         => $this->faker->time('H:i'),
            'total_price'      => $this->faker->randomFloat(2, 50, 200),
            'status'           => 'confirmed',
        ];
    }
}
