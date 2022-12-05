<?php

declare(strict_types=1);

use Apitte\Core\Application;
use App\Bootstrap;
use Nette\Application\Application as UIApplication;

require __DIR__ . '/../vendor/autoload.php';

$isApi = substr($_SERVER['REQUEST_URI'], 0, 4) === '/api';
$container = Bootstrap::boot()->createContainer();

if ($isApi) {
    // Apitte application
    $container->getByType(ApiApplication::class)->run();
} else {
    // Nette application
    $container->getByType(UIApplication::class)->run();
}

/* $configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
$application->run(); */
