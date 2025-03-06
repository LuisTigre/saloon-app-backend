<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Booking;
use App\Models\Hairstyle;
use App\Models\HairstyleAttribute;
use App\Models\HairstyleAttributeValue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Ensure at least one user exists
        $user = User::firstOrCreate([
            'id' => 1,
        ], [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Ensure at least one hairstyle exists
        $hairstyle = Hairstyle::firstOrCreate([
            'id' => 1,
            'name' => 'Box Braids',
            'duration' => 180,
            'price' => 120.00,
        ]);

        // Ensure that at least one hairstyle attribute exists
        // You must first create a record in the `hairstyle_attributes` table if not done yet
        $hairstyleAttribute = HairstyleAttribute::firstOrCreate([
            'name' => 'Braid Size',
            'category' => 'Hair Type'  // Optional, add if applicable
        ]);

        // Ensure at least one hairstyle attribute value exists
        $hairstyleAttributeValue = HairstyleAttributeValue::firstOrCreate([
            'hairstyle_attribute_id' => $hairstyleAttribute->id,
            'value' => 'Small',  // or any other value you need
        ]);

        // Create a booking record
        $booking = Booking::create([
            'customer_id' => 1, // Ensure a user with id 1 exists
            'hairstyle_id' => 1, // Ensure a hairstyle with id 1 exists
            'appointment_date' => now(),
            'start_time' => '10:00:00',
            'end_time' => '12:00:00',
            'total_price' => 100.00,
            'status' => 'confirmed',
        ]);

        // Now, insert into the booking_attribute_values table, ensuring that IDs are correct
        DB::table('booking_attribute_values')->insert([
            'booking_id' => $booking->id, // Use the created booking ID
            'hairstyle_attribute_value_id' => $hairstyleAttributeValue->id, // Use the created hairstyle attribute value ID
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
