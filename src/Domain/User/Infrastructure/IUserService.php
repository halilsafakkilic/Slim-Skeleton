<?php

namespace App\Domain\User\Infrastructure;

use App\Domain\User\Model\User;

interface IUserService
{
    public function findAll(): array;

    public function findUserOfId(int $id): User;
}