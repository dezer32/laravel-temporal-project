<?php

declare(strict_types=1);

namespace Dezer32\TemporalProject\Core\Console\Commands;

use Dezer32\TemporalProject\Core\Services\WorkerServiceInterface;
use Illuminate\Console\Command;

class ServerInitCommand extends Command
{
    protected static $defaultName = 'temporal-project:server:init';
    protected static $defaultDescription = 'Command of init app server';

    public function handle(WorkerServiceInterface $service): void
    {
        $service->handle();
    }
}
