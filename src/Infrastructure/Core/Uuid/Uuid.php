<?php

namespace App\Infrastructure\Core\Uuid;

use Ramsey\Uuid\Codec\OrderedTimeCodec;

class Uuid implements IUuid
{
    private string $_uuid;

    public function __construct(string $uuid)
    {
        $this->_uuid = $uuid;
    }

    public function __toString()
    {
        return $this->_uuid;
    }

    public function toString()
    {
        return $this->__toString();
    }

    public static function generate()
    {
        $factory = clone \Ramsey\Uuid\Uuid::getFactory();

        $codec = new OrderedTimeCodec(
            $factory->getUuidBuilder()
        );

        $factory->setCodec($codec);

        return new self($factory->uuid1()->toString());
    }

    public static function fromString(string $uuid): IUuid
    {
        \Ramsey\Uuid\Uuid::fromString($uuid);

        return new self($uuid);
    }

    public static function isValid(string $uuid): bool
    {
        return \Ramsey\Uuid\Uuid::isValid($uuid);
    }
}