<?php

declare(strict_types=1);

namespace Dezer32\TemporalProject\Core\Providers;

use Dezer32\TemporalProject\Core\Console\Commands\WorkflowInitCommand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;
use Temporal\Client\WorkflowClientInterface;
use Temporal\Worker\WorkerFactoryInterface;
use Temporal\Worker\WorkerInterface;
use Temporal\WorkerFactory;

class CoreTemporalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/workflow.php', 'workflow');

        $this->app->singleton(
            WorkerFactoryInterface::class,
            static fn(): WorkerFactoryInterface => WorkerFactory::create()
        );

        $this->app->singleton(WorkerInterface::class, static function (Application $app) {
            return $app->get(WorkerFactoryInterface::class)->newWorker();
        });

        $this->app->singleton(
            WorkflowClientInterface::class,
            static fn() => WorkflowClient::create(ServiceClient::create((string) Config::get('workflow.address')))
        );

        if ($this->app->runningInConsole()) {
            $this->commands(WorkflowInitCommand::class);
        }
    }
}
