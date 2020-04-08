<?php

namespace App\Service\User\Query\FindUser;

use App\Domain\User\Infrastructure\IUserRepository;
use App\Domain\User\Model\User;
use App\Infrastructure\Service\IQueryHandler;

class FindUserQueryHandler implements IQueryHandler
{
    private IUserRepository $_repository;

    public function __construct(IUserRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @param FindUserQuery $query
     *
     * @return User[]
     */
    public function handler($query)
    {
        return $this->_repository->findAll();
    }
}