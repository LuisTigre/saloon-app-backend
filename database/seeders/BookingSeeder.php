<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\BraidingStyle;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();
        $styles = BraidingStyle::all();

        foreach ($users as $user) {
            foreach ($styles as $style) {
                Booking::create([
                    'customer_id' => $user->id,
                    'style_id' => $style->id,
                    'appointment_date' => now()->addDays(rand(1, 30)),
                    'start_time' => now()->addHours(rand(1, 12))->format('H:i'),
                    'end_time' => now()->addHours(rand(13, 24))->format('H:i'),
                    'total_price' => rand(50, 200),
                    'status' => 'confirmed',
                ]);
            }
        }
    }
}