<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_requires_valid_email() 
    {
        $response = $this->postJson('/api/register', [
            'email' => 'invalid-email',
            'password' => 'password123'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_register_password_validation() 
    {
        $response = $this->postJson('/api/register', [
            'email' => 'test@example.com',
            'password' => 'short',
        ]);

        $response->assertStatus(422);
    }

    public function test_login_with_correct_credentials() 
    {
        $user = User::factory()->create([
            'email' => 'test456@example.com',
            'password' => bcrypt('password'),
            'name' => 'Test User'
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test456@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());
    }

    public function test_login_with_incorrect_credentials() 
    {

        $user = User::factory()->create([
            'email' => 'test789@example.com',
            'password' => bcrypt('correctpassword'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test789@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
    }
}
