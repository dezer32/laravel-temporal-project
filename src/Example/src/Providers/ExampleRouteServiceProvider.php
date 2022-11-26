<?php

declare(strict_types=1);

namespace Dezer32\TemporalProject\Example\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class ExampleRouteServiceProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('temporal-project/example')
            ->name('temporal-project.example.')
            ->group(__DIR__ . '/../../routes/api.php');
    }
}
