<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\StyleAttributeValue;
use App\Models\BraidingStyle;
use App\Models\StyleAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StyleAttributeValueControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create an admin or regular user as needed
        $this->user = User::factory()->create();
    }

    public function test_index()
    {
        StyleAttributeValue::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->getJson('/api/style-attribute-values');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_store()
    {
        $style = BraidingStyle::factory()->create();
        $attribute = StyleAttribute::factory()->create();

        $data = [
            'style_id'     => $style->id,
            'attribute_id' => $attribute->id,
            'value'        => 'Red',
        ];

        $response = $this->actingAs($this->user, 'sanctum')
                         ->postJson('/api/style-attribute-values', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);
    }

    public function test_show()
    {
        $attributeValue = StyleAttributeValue::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->getJson("/api/style-attribute-values/{$attributeValue->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $attributeValue->id]);
    }

    public function test_update()
    {
    $attributeValue = StyleAttributeValue::factory()->create();

    $newData = [
        'style_id'     => $attributeValue->style_id,
        'attribute_id' => $attributeValue->attribute_id,
        'value'        => 'Blue',
    ];

    $response = $this->actingAs($this->user, 'sanctum')
                     ->putJson("/api/style-attribute-values/{$attributeValue->id}", $newData);

    $response->assertStatus(200)
             ->assertJsonFragment($newData);
    }

    public function test_destroy()
    {
        $attributeValue = StyleAttributeValue::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
                         ->deleteJson("/api/style-attribute-values/{$attributeValue->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('style_attribute_values', ['id' => $attributeValue->id]);
    }
}