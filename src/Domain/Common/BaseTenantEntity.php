<?php

namespace App\Domain\Common;

use App\Domain\Tenant\Model\Tenant;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

abstract class BaseTenantEntity extends BaseEntity
{
    /** @ORM\Column(type="uuid_ordered_time", name="tenant_id") */
    protected UuidInterface $tenantId;

    /**
     * @ORM\JoinColumn(name="tenant_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected Tenant $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function getTenantID(): string
    {
        return $this->tenantId->toString();
    }
}