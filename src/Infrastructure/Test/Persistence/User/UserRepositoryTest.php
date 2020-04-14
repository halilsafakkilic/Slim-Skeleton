<?php

namespace App\Service\User\Test;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Model\User;
use App\Infrastructure\Core\Uuid\Uuid;
use App\Infrastructure\Persistence\User\UserRepository;
use App\Infrastructure\Test\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $user = new User('bill.gates', 'Bill', 'Gates');

        $userRepository = new UserRepository([1 => $user]);

        $this->assertEquals([$user], $userRepository->findAll());
    }

    public function testFindUserOfId()
    {
        $id = Uuid::generate();

        $user = new User('bill.gates', 'Bill', 'Gates', $id);

        $userRepository = new UserRepository([$id->toString() => $user]);

        $this->assertEquals($user, $userRepository->findUserOfId($id));
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