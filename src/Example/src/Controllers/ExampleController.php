<?php

declare(strict_types=1);

namespace Dezer32\TemporalProject\Example\Controllers;

use App\Http\Controllers\Controller;
use Carbon\CarbonInterval;
use Dezer32\TemporalProject\Example\Workflows\Greeting\GreetingWorkflowInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Temporal\Client\WorkflowClientInterface;
use Temporal\Client\WorkflowOptions;

class ExampleController extends Controller
{
    public function simpleActivity(Request $request, WorkflowClientInterface $workflowClient): JsonResponse
    {
        $workflow = $workflowClient->newWorkflowStub(
            GreetingWorkflowInterface::class,
            WorkflowOptions::new()->withWorkflowExecutionTimeout(CarbonInterval::minute())
        );

        $run = $workflowClient->start($workflow, 'Dezer32');

        return new JsonResponse([
            'workflow' => [
                'id' => $run->getExecution()->getID(),
            ],
        ]);
    }
}
