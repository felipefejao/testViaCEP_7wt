<?php

namespace App\Providers;

use App\Services\ViaCepService;
use App\Services\ViaCepServiceContract;
use Illuminate\Support\ServiceProvider;

class ViaCepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ViaCepServiceContract::class,
            ViaCepService::class
        );
    }

    public function provides()
    {
        return [
            ViaCepServiceContract::class
        ];
    }
}
