<?php

namespace App\API\Controller\User;

use App\API\Controller\Action;
use App\API\DTO\User\UserDTO;
use App\Service\User\Query\GetUser\GetUserQuery;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class ViewUserAction extends Action
{
    private const ERROR_NOT_FOUND = 'User not found!';

    /**
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    protected function handle(): Response
    {
        $id = $this->resolveArg('id');
        if (!$id) {
            throw new HttpNotFoundException($this->request, self::ERROR_NOT_FOUND);
        }

        $query = new GetUserQuery();
        $query->id = $id;

        $user = $this->service->sendQuery($query);
        if (!$user) {
            throw new HttpNotFoundException($this->request, self::ERROR_NOT_FOUND);
        }

        $this->logger->info("User of id `{id}` was viewed.");

        return $this->respond(new UserDTO($user));
    }
}