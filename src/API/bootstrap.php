<?php

use Slim\App;

/** @var App $app */

// Register middleware
$middleware = require(__DIR__ . '/middleware.php');
$middleware($app);

// Register routes
$routes = require(__DIR__ . '/routes.php');
$routes($app);

// Add Routing Middleware
$app->addRoutingMiddleware();