<?php

declare(strict_types=1);

return [
    'address' => env('TEMPORAL_CLI_ADDRESS'),
    'server' => [
        'command' => env('TEMPORAL_CLI_SERVER_COMMAND', 'php artisan workflow:init'),
    ],
];
