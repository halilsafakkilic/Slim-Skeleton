<?php
declare(strict_types=1);

use App\API\Infrastructure\ErrorHandler;
use App\API\Infrastructure\ResponseEmitter;
use App\API\Infrastructure\ShutdownHandler;
use Slim\Factory\ServerRequestCreatorFactory;

// Bootstrap
require_once(__DIR__ . '/../app/bootstrap.php');

// API Initialize
require(APP_DIR . '/src/API/bootstrap.php');

/** @var bool $displayErrorDetails */
$displayErrorDetails = $app->getContainer()->get('settings')['displayErrorDetails'];

// Create Request object from globals
$request = ServerRequestCreatorFactory::create()->createServerRequestFromGlobals();

// Create Error Handler
$errorHandler = new ErrorHandler($app->getCallableResolver(), $app->getResponseFactory());

// Create Shutdown Handler
register_shutdown_function(new ShutdownHandler($request, $errorHandler, $displayErrorDetails));

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, false, false);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

// Run App & Emit Response
(new ResponseEmitter())->emit($app->handle($request));