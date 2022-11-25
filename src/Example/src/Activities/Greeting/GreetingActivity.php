<?php

declare(strict_types=1);

namespace Dezer32\TemporalProject\Example\Activities\Greeting;

class GreetingActivity implements GreetingActivityInterface
{
    public function composeGreeting(string $greeting, string $name): string
    {
        return $greeting . ' ' . $name;
    }
}
