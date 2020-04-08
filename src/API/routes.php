<?php

use App\API\Controller\Tenant\AddTenantAction;
use App\API\Controller\Tenant\ViewTenantAction;
use App\API\Controller\User\ListUsersAction;
use App\API\Controller\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function(App $app) {
    $app->get('/', function(Request $request, Response $response) {
        $response->getBody()->write('Hello world!');

        return $response;
    });

    $app->group('/users', function(Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/tenants', function(Group $group) {
        $group->post('/', AddTenantAction::class);
        $group->get('/{id}', ViewTenantAction::class);
    });
};