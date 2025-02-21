<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\StyleImage;
use App\Models\BraidingStyle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StyleImageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Ensure an authenticated user is available for all tests
        $this->user = User::factory()->create();
    }

    public function test_index()
    {
        StyleImage::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->getJson('/api/style-images');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_store()
    {
        $style = BraidingStyle::factory()->create();

        $data = [
            'style_id'      => $style->id,
            'image_url'     => 'https://example.com/image.jpg',
            'is_main_image' => true,
        ];

        $response = $this->actingAs($this->user, 'sanctum')
                         ->postJson('/api/style-images', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);
    }

    public function test_show()
    {
        $image = StyleImage::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->getJson("/api/style-images/{$image->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $image->id]);
    }

    public function test_update()
    {
        $image = StyleImage::factory()->create();
        $newData = [
        'style_id'      => $image->style_id,         // include the existing style_id
        'image_url'     => 'https://example.com/new-image.jpg',
        'is_main_image' => !$image->is_main_image,     // change the value for example
    ];

        $response = $this->actingAs($this->user, 'sanctum')
                     ->putJson("/api/style-images/{$image->id}", $newData);

        $response->assertStatus(200)
             ->assertJsonFragment($newData);
    }

    public function test_destroy()
    {
        $image = StyleImage::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->deleteJson("/api/style-images/{$image->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('style_images', ['id' => $image->id]);
    }
}