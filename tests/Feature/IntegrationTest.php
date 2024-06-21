<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Integration;
use Laravel\Passport\Passport;

class IntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->token = $response->json('token');
    }

    public function test_add_integration() 
    {    
        $response = $this->postJson('/api/integration', [
            'marketplace' => 'hepsiburada',
        ], ['Authorization' => 'Bearer ' . $this->token]);
    
        $response->assertStatus(201);
        $this->assertDatabaseHas('integrations', [
            'marketplace' => 'hepsiburada',
        ]);
    }

    public function test_integration_update() 
    {
        $integration = Integration::factory()->create([
            'marketplace' => 'hepsiburada',
        ]);

        echo $integration->id;

        $response = $this->putJson("/api/integration/{$integration->id}", [
            'marketplace' => 'trendyol',
        ], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('integrations', [
            'id' => $integration->id,
            'marketplace' => 'trendyol',
        ]);
    }

    public function test_integration_delete() 
    {
        $integration = Integration::factory()->create();

        $response = $this->deleteJson("/api/integration/{$integration->id}", [], ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('integrations', [
            'id' => $integration->id,
        ]);
    }
}
