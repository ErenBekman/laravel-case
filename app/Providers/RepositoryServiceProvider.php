<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\IntegrationRepositoryInterface;
use App\Services\Repositories\IntegrationRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IntegrationRepositoryInterface::class, IntegrationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
