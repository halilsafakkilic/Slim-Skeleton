<?php

namespace App\Domain\Tenant\Infrastructure;

use App\Domain\Tenant\Model\Tenant;
use App\Infrastructure\Core\Uuid\IUuid;

interface ITenantRepository
{
    public function addRandom(IUuid $id);

    public function findByID(string $id): ?Tenant;
}