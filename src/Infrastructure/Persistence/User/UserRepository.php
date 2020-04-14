<?php

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\Model\User;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Infrastructure\IUserRepository;
use App\Infrastructure\Core\Uuid\Uuid;

class UserRepository implements IUserRepository
{
    /**
     * @var User[]
     */
    private $users;

    /**
     * In Memory Repository
     *
     * @param array|null $users
     */
    public function __construct(array $users = null)
    {
        $id1 = Uuid::fromString('bba7d06e-7cea-11ea-b490-0242ac130002');
        $id2 = Uuid::fromString('bba7f77e-7cea-11ea-844a-0242ac130002');
        $id3 = Uuid::fromString('bba80700-7cea-11ea-8273-0242ac130002');
        $id4 = Uuid::fromString('bba8165a-7cea-11ea-bc11-0242ac130002');
        $id5 = Uuid::fromString('bba825d2-7cea-11ea-842c-0242ac130002');

        $this->users = $users ?? [
                (string) $id1 => new User('bill.gates', 'Bill', 'Gates', $id1),
                (string) $id2 => new User('steve.jobs', 'Steve', 'Jobs', $id2),
                (string) $id3 => new User('mark.zuckerberg', 'Mark', 'Zuckerberg', $id3),
                (string) $id4 => new User('evan.spiegel', 'Evan', 'Spiegel', $id4),
                (string) $id5 => new User('jack.dorsey', 'Jack', 'Dorsey', $id5),
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->users);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(string $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }
}