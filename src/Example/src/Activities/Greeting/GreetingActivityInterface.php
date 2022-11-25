<?php

namespace Dezer32\TemporalProject\Example\Activities\Greeting;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface(prefix: "SimpleActivity.")]
interface GreetingActivityInterface
{
    #[ActivityMethod(name: "ComposeGreeting")]
    public function composeGreeting(string $greeting, string $name): string;
}
