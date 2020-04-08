<?php

namespace App\Service\User\Test;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Model\User;
use App\Infrastructure\Persistence\User\UserRepository;
use App\Infrastructure\Test\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new UserRepository([1 => $user]);

        $this->assertEquals([$user], $userRepository->findAll());
    }

    public function testFindUserOfId()
    {
        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new UserRepository([1 => $user]);

        $this->assertEquals($user, $userRepository->findUserOfId(1));
    }

    /**
     * @throws UserNotFoundException
     */
    public function testFindUserOfIdThrowsNotFoundException()
    {
        $this->expectException(UserNotFoundException::class);

        $userRepository = new UserRepository([]);
        $userRepository->findUserOfId(1);
    }
}