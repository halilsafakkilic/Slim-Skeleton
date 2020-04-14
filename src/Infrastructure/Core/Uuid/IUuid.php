<?php

namespace App\Infrastructure\Core\Uuid;

interface IUuid
{
    public function toString();

    public static function fromString(string $uuid): IUuid;

    public static function isValid(string $uuid): bool;
}