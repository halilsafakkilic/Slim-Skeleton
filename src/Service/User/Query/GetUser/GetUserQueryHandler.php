<?php

namespace App\Service\User\Query\GetUser;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Infrastructure\IUserRepository;
use App\Domain\User\Model\User;
use App\Infrastructure\Service\IQueryHandler;

class GetUserQueryHandler implements IQueryHandler
{
    private IUserRepository $_repository;

    public function __construct(IUserRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @param GetUserQuery $query
     *
     * @return User
     * @throws UserNotFoundException
     */
    public function handler($query)
    {
        return $this->_repository->findUserOfId($query->id);
    }
}