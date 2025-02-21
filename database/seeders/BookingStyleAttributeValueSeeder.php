<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\StyleAttributeValue;

class BookingStyleAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For each booking, attach a random subset (1 to 3) of style attribute values
        Booking::all()->each(function ($booking) {
            $attributeValueIds = StyleAttributeValue::inRandomOrder()
                ->take(rand(1, 3))
                ->pluck('id')
                ->toArray();

            $booking->attributeValues()->sync($attributeValueIds);
        });
    }
}