<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookingAttributeValue; // Ensure this import is correct

class BookingAttributeValueSeeder extends Seeder
{
    public function run()
    {
        BookingAttributeValue::create([
            'booking_id' => 1,
            'hairstyle_attribute_value_id' => 1,
        ]);
    }
}

