<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AuthTest extends TestCase
{
    use RefreshDatabase; // Resets the database after each test

     /** @test */
     public function a_user_can_register_successfully()
     {
         $response = $this->postJson('/api/register', [
             "name" => "John Doe",
             "email" => "johndoe@example.com",
             "password" => "SecurePassword123",
             "password_confirmation" => "SecurePassword123",
             "role" => "client"
         ]);
 
         // Assertions
         $response->assertStatus(201) // Check if the response status is 201 (Created)
                  ->assertJsonStructure([
                      'user' => [
                          'id',
                          'name',
                          'email',
                          'role',
                          'created_at',
                          'updated_at'
                      ],
                      'token'
                  ]);
         
         // Ensure the user is in the database
         $this->assertDatabaseHas('users', [
             'email' => 'johndoe@example.com',
             'name' => 'John Doe',
             'role' => 'client'
         ]);
     }

    /** @test */
    public function a_user_can_login()
    {
        // Create a test user
        $user = User::factory()->create([
            'email' => 'client@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Send a POST request to the login endpoint
        $response = $this->postJson('/api/login', [
            'email' => 'client@example.com',
            'password' => 'password123',
        ]);

        // Assertions
        $response->assertStatus(200) // Ensure it's a successful response
                 ->assertJsonStructure(['token']); // Ensure a token is returned
    }

    /** @test */
    public function a_user_can_logout()
    {
        // Create a test user and authenticate with Sanctum
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // Send a POST request to logout
        $response = $this->postJson('/api/logout');

        // Assertions
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Successfully logged out.']);

    }
}
