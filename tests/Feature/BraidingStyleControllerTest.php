<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\BraidingStyle;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BraidingStyleControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user; // Add this to store the authenticated user

    protected function setUp(): void
    {
        parent::setUp();
        // Create and authenticate a user
        $this->user = User::factory()->create();
    }

    public function test_index()
    {
        BraidingStyle::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'sanctum') // Authenticate user
                         ->getJson('/api/braiding-styles');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_store()
    {
        $data = [
            'style_name' => 'Box Braids',
            'description' => 'Long-lasting braids',
            'duration' => 120,
            'price' => 150.00,
        ];

        $response = $this->actingAs($this->user, 'sanctum') // Authenticate user
                         ->postJson('/api/braiding-styles', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);
    }

    public function test_show()
    {
        $style = BraidingStyle::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum') // Authenticate user
                         ->getJson("/api/braiding-styles/{$style->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $style->id]);
    }

    public function test_update()
    {
        $style = BraidingStyle::factory()->create();
    
        $newData = [
            'style_name' => $style->style_name, // Keep the existing value
            'description' => $style->description, // Keep the existing value
            'duration' => $style->duration, // Keep the existing value
            'price' => 200.00, // Only updating price
    ];

        $response = $this->actingAs($this->user, 'sanctum')
                     ->putJson("/api/braiding-styles/{$style->id}", $newData);

        $response->assertStatus(200)
                    ->assertJsonFragment($newData);
    }

    public function test_destroy()
    {
        $style = BraidingStyle::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum') // Authenticate user
                         ->deleteJson("/api/braiding-styles/{$style->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('braiding_styles', ['id' => $style->id]);
    }
}
