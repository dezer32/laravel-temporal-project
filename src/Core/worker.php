<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\RoadRunner\Http\PSR7Worker;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

require __DIR__ . "/../../vendor/autoload.php";

/** @var Application $app */
$app = require __DIR__ . '/../../bootstrap/app.php';

$worker = \Spiral\RoadRunner\Worker::create();
$psr17Factory = new Psr17Factory();

$psr7Worker = new PSR7Worker($worker, $psr17Factory, $psr17Factory, $psr17Factory);

$httpSymfonyFactory = new HttpFoundationFactory();
$psr7HttpMessageFactory = new PsrHttpFactory(
    $psr17Factory,
    $psr17Factory,
    $psr17Factory,
    $psr17Factory
);

while ($req = $psr7Worker->waitRequest()) {
    if (!($req instanceof ServerRequestInterface)) { // Termination request received
        break;
    }

    try {
        $request = Request::createFromBase($httpSymfonyFactory->createRequest($req));

        /** @var Kernel $kernel */
        $kernel = $app->make(Kernel::class);
        $res = $kernel->handle($request);
        $kernel->terminate($request, $res);

        $response = $psr7HttpMessageFactory->createResponse($res);

        $psr7Worker->respond($response);
    } finally {
        unset($req, $request, $kernel, $res, $response);
    }
}
