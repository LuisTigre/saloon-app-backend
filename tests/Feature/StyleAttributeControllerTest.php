<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\StyleAttribute;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StyleAttributeControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create an admin or regular user as needed
        $this->user = User::factory()->create();
    }

    public function test_index()
    {
        StyleAttribute::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->getJson('/api/style-attributes');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_store()
    {
        $data = [
            'attribute_name' => 'Color',
        ];

        $response = $this->actingAs($this->user, 'sanctum')
                         ->postJson('/api/style-attributes', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);
    }

    public function test_show()
    {
        $attribute = StyleAttribute::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->getJson("/api/style-attributes/{$attribute->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $attribute->id]);
    }

    public function test_update()
    {
        $attribute = StyleAttribute::factory()->create();
        $newData = [
            'attribute_name' => 'Length',
        ];

        $response = $this->actingAs($this->user, 'sanctum')
                         ->putJson("/api/style-attributes/{$attribute->id}", $newData);

        $response->assertStatus(200)
                 ->assertJsonFragment($newData);
    }

    public function test_destroy()
    {
        $attribute = StyleAttribute::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->deleteJson("/api/style-attributes/{$attribute->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('style_attributes', ['id' => $attribute->id]);
    }
}