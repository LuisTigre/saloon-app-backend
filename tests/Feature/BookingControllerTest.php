<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Booking;
use App\Models\User;
use App\Models\BraidingStyle;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_index()
    {
        Booking::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/bookings');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        $style = BraidingStyle::factory()->create();

        $data = [
            'customer_id'      => $user->id,
            'style_id'         => $style->id,
            'appointment_date' => '2025-02-21',
            'start_time'       => '10:00',
            'end_time'         => '11:00',
            'total_price'      => 100.00,
            'status'           => 'Confirmed', // Use allowed enum value
        ];

        $response = $this->actingAs($this->user)->postJson('/api/bookings', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);
    }

    public function test_show()
    {
        $booking = Booking::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/bookings/{$booking->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $booking->id]);
    }

    public function test_update()
    {
        $booking = Booking::factory()->create();
        
        // Ensure new end_time is after start_time
        $startTime    = $booking->start_time;
        $newEndTime   = date("H:i", strtotime($startTime) + 3600);

        $newData = [
            'customer_id'      => $booking->customer_id,
            'style_id'         => $booking->style_id,
            'appointment_date' => $booking->appointment_date,
            'start_time'       => $startTime,
            'end_time'         => $newEndTime,
            'total_price'      => $booking->total_price,
            'status'           => 'Confirmed', // Use allowed enum value
        ];

        $response = $this->actingAs($this->user)
                         ->putJson("/api/bookings/{$booking->id}", $newData);

        $response->assertStatus(200)
                 ->assertJsonFragment($newData);
    }

    public function test_destroy()
    {
        $booking = Booking::factory()->create();

        $response = $this->actingAs($this->user)->deleteJson("/api/bookings/{$booking->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }
}