<?php

use App\API\Controller\Tenant\AddTenantAction;
use App\API\Controller\Tenant\ViewTenantAction;
use App\API\Controller\User\ListUsersAction;
use App\API\Controller\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="Playground API", version="0.1")
 * @OA\Server(url=API_BASE)
 */

return function(App $app) {
    /**
     * @OA\Tag(name="Other", description="About everything else")
     *
     * @OA\Get(
     *     tags={"Other"},
     *     path="/",
     *     summary="Welcome page",
     *     @OA\Response(response=200, description="Success"),
     *     )
     */
    $app->get('/', function(Request $request, Response $response) {
        $response->getBody()->write('Hello World');

        return $response;
    });

    /**
     * @OA\Tag(name="Users", description="Everything about your Users")
     */
    $app->group('/users', function(Group $group) {
        /**
         * @OA\Get(
         *     tags={"Users"},
         *     path="/users",
         *     summary="list users",
         *     @OA\Response(response=200, description="Success", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))),
         *     )
         */
        $group->get('', ListUsersAction::class);

        /**
         * @OA\Get(
         *     tags={"Users"},
         *     path="/users/{id}",
         *     summary="get user",
         *     @OA\Parameter(name="id",in="path",required=true),
         *     @OA\Response(response=200, description="Success", @OA\JsonContent(ref="#/components/schemas/User")),
         *     )
         */
        $group->get('/{id}', ViewUserAction::class);
    });

    /**
     * @OA\Tag(name="Tenants", description="Everything about your Tenants")
     */
    $app->group('/tenants', function(Group $group) {
        /**
         * @OA\Post(
         *     tags={"Tenants"},
         *     path="/tenants/",
         *     summary="add dummy tenant",
         *     @OA\Response(response=200, description="Success", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/NewItem"))),
         *     )
         */
        $group->post('/', AddTenantAction::class);

        /**
         * @OA\Get(
         *     tags={"Tenants"},
         *     path="/tenants/{id}",
         *     summary="get tenant",
         *     @OA\Parameter(name="id",in="path",required=true),
         *     @OA\Response(response=200, description="Success", @OA\JsonContent(ref="#/components/schemas/Tenant")),
         *     @OA\Response(response="default", description="In all cases of errors", @OA\JsonContent(ref="#/components/schemas/Error"),
         *   ),
         * )
         */
        $group->get('/{id}', ViewTenantAction::class);
    });
};