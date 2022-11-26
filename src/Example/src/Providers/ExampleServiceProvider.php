<?php

declare(strict_types=1);

namespace Dezer32\TemporalProject\Example\Providers;

use Dezer32\TemporalProject\Example\Console\Commands\GreetingExecuteCommand;
use Illuminate\Support\ServiceProvider;

class ExampleServiceProvider extends ServiceProvider
{
    private array $commands = [
        GreetingExecuteCommand::class,
    ];

    public function register(): void
    {
        $this->app->register(ExampleTemporalServiceProvider::class);
        $this->app->register(ExampleRouteServiceProvider::class);

        $this->registerCommands();
    }

    private function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }
}
