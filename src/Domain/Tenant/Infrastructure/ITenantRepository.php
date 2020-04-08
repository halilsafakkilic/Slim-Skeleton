<?php

namespace App\Domain\Tenant\Infrastructure;

use App\Domain\Tenant\Model\Tenant;

interface ITenantRepository
{
    public function addRandom(): string;

    public function findByID(string $id): ?Tenant;
}