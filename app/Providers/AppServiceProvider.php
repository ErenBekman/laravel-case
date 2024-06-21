<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\RepositoryServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Passport::loadKeysFrom(__DIR__.'/../storage/oauth');
        Passport::hashClientSecrets();
    }
}
