<?php

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Model\User;
use App\Domain\User\Exception\UserNotFoundException;

interface IUserRepository
{
    /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param string $id
     *
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(string $id): User;
}