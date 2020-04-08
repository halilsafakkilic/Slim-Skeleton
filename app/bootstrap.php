<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require_once(__DIR__ . '/constants.php');

require_once(APP_DIR . '/vendor/autoload.php');

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (APP_ENV != 'development') {
    $containerBuilder->enableCompilation(APP_DIR . '/storage/cache');
}

// Set up settings
$settings = require(__DIR__ . '/containers/settings.php');
$settings($containerBuilder);

// Set up dependencies
$dependencies = require(__DIR__ . '/containers/dependencies.php');
$dependencies($containerBuilder);

// Set up repositories
$repositories = require(APP_DIR . '/src/Infrastructure/repositories.php');
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();