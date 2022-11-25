<?php

declare(strict_types=1);

namespace Dezer32\TemporalProject\Example\Providers;

use Dezer32\TemporalProject\Core\Providers\TemporalServiceProvider;
use Dezer32\TemporalProject\Example\Activities\Greeting\GreetingActivity;
use Dezer32\TemporalProject\Example\Activities\Greeting\GreetingActivityInterface;
use Dezer32\TemporalProject\Example\Workflows\Greeting\GreetingWorkflow;
use Dezer32\TemporalProject\Example\Workflows\Greeting\GreetingWorkflowInterface;

class ExampleTemporalServiceProvider extends TemporalServiceProvider
{
    protected array $activityBindings = [
        GreetingActivityInterface::class => GreetingActivity::class,
    ];
    protected array $workflowBindings = [
        GreetingWorkflowInterface::class => GreetingWorkflow::class,
    ];
}
