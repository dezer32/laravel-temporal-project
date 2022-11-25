<?php

declare(strict_types=1);

namespace Dezer32\TemporalProject\Core\Providers;

use Dezer32\TemporalProject\Example\Providers\ExampleServiceProvider;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    private array $providers = [
        CoreTemporalServiceProvider::class,
        ExampleServiceProvider::class,
    ];

    public function register(): void
    {
        $this->registerProviders();
    }

    private function registerProviders(): void
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
