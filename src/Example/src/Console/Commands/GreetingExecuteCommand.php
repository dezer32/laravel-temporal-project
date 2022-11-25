<?php

declare(strict_types=1);

namespace Dezer32\TemporalProject\Example\Console\Commands;

use Carbon\CarbonInterval;
use Dezer32\TemporalProject\Example\Workflows\Greeting\GreetingWorkflowInterface;
use Illuminate\Console\Command;
use Temporal\Client\WorkflowClientInterface;
use Temporal\Client\WorkflowOptions;

class GreetingExecuteCommand extends Command
{
    protected $signature = 'example:simple-activity';
    protected $description = 'Execute Dezer32\TemporalProject\Example\GreetingWorkflow';

    public function handle(WorkflowClientInterface $workflowClient): int
    {
        $workflow = $workflowClient->newWorkflowStub(
            GreetingWorkflowInterface::class,
            WorkflowOptions::new()->withWorkflowExecutionTimeout(CarbonInterval::minute())
        );

        $this->getOutput()->info("Starting <comment>GreetingWorkflow</comment>... ");

        // Start a workflow execution. Usually this is done from another program.
        // Uses task queue from the GreetingWorkflow @WorkflowMethod annotation.
        $run = $workflowClient->start($workflow, 'Antony');

        $this->getOutput()->info(
            sprintf(
                'Started: WorkflowID=<fg=magenta>%s</fg=magenta>',
                $run->getExecution()->getID(),
            )
        );

        // getResult waits for workflow to complete
        $this->getOutput()->info(sprintf("Result:\n<info>%s</info>", $run->getResult()));

        return self::SUCCESS;
    }
}
