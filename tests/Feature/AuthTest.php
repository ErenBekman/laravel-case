<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Laravel\Passport\ClientRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class AuthTest extends TestCase
{
    // use RefreshDatabase;

    protected $client, $user, $token;

    public function setUp(): void
    {
        parent::setUp();

        $clientRepository = new ClientRepository();

        $client = $clientRepository->createPersonalAccessClient(
            null, 'test', 'http://localhost'
        );
        
        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        $this->user = $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        Passport::actingAs($user);

        $this->token = $this->user->createToken('TestToken')->accessToken;

        $this->headers['Accept'] = 'application/json';

        // $this->headers['Authorization'] = 'Bearer '.$token;
    }


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

    public function test_register_with_valid_data() 
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        $response->assertJsonStructure(['token']);
    }

    public function test_login_with_correct_credentials() 
    {
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        $this->assertArrayHasKey('token', $response->json());
    }

    public function test_login_with_incorrect_credentials() 
    {
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
    }
}
