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
    private WorkflowClientInterface $workflowClient;

    public function __construct(WorkflowClientInterface $workflowClient)
    {
        $this->workflowClient = $workflowClient;
    }

    public function simpleActivity(Request $request): JsonResponse
    {
        $workflow = $this->workflowClient->newWorkflowStub(
            GreetingWorkflowInterface::class,
            WorkflowOptions::new()->withWorkflowExecutionTimeout(CarbonInterval::minute())
        );

        $run = $this->workflowClient->start($workflow, $request->get('name', 'Dezer32'));

        return new JsonResponse([
            'workflow' => [
                'id' => $run->getExecution()->getID(),
                // waits for workflow to complete
                'result' => $run->getResult(),
            ],
        ]);
    }
}
