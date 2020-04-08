<?php

namespace App\Domain\Common;

use BadMethodCallException;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

class BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid_ordered_time")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidOrderedTimeGenerator")
     */
    protected UuidInterface $id;

    public function getID(): string
    {
        return $this->id;
    }

    public function __clone()
    {
        throw new BadMethodCallException("clone action is not allowed!");
    }

    public function __wakeup()
    {
        throw new BadMethodCallException("wakeup action is not allowed!");
    }

    public function __unserialize(array $data): void
    {
        throw new BadMethodCallException("unserialize action is not allowed!");
    }
}