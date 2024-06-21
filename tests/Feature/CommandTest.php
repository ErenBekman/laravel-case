<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Integration;

class CommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_integration_command() 
    {
        $this->artisan('integration:manage create --marketplace=hepsiburada --username=username --password=password')
            ->expectsOutput('Integration added successfully.')
            ->assertExitCode(0);

        $this->assertDatabaseHas('integrations', [
            'marketplace' => 'hepsiburada',
            'username' => 'username'
        ]);
    }

    public function test_update_integration_command() 
    {
        $integration = Integration::factory()->create([
            'marketplace' => 'hepsiburada',
            'username' => 'username',
            'password' => 'password'
        ]);

        $this->artisan('integration:manage update --id=' . $integration->id . ' --marketplace=trendyol --username=newuser --password=newpass')
            ->expectsOutput('Integration updated successfully.')
            ->assertExitCode(0);

        $this->assertDatabaseHas('integrations', [
            'id' => $integration->id,
            'marketplace' => 'trendyol',
            'username' => 'newuser',
            'password' => 'newpass'
        ]);
    }

    public function test_delete_integration_command() 
    {
        $integration = Integration::factory()->create();

        $this->artisan('integration:manage delete --id=' . $integration->id)
            ->expectsOutput('Integration deleted successfully.')
            ->assertExitCode(0);

        $this->assertDatabaseMissing('integrations', [
            'id' => $integration->id
        ]);
    }
}
