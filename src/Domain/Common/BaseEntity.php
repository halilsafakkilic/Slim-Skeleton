<?php

namespace App\Domain\Common;

use App\Infrastructure\Core\Uuid\IUuid;
use App\Infrastructure\Core\Uuid\Uuid;
use BadMethodCallException;
use Doctrine\ORM\Mapping as ORM;

abstract class BaseEntity implements IDomain
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid_ordered_time")
     */
    protected IUuid $id;

    public function __construct(?IUuid $id)
    {
        if (is_null($id)) {
            $id = Uuid::generate();
        }

        $this->id = $id;
    }

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