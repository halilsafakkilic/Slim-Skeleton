<?php

namespace App\API\Controller\User;

use App\API\Controller\Action;
use App\Service\User\Query\FindUser\FindUserQuery;
use Psr\Http\Message\ResponseInterface as Response;

class ListUsersAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function handle(): Response
    {
        $users = $this->service->sendQuery(new FindUserQuery());

        $this->logger->info("Users list was viewed.");

        return $this->respondWithData($users);
    }
}