<?php

namespace App\Domain\Common;

use App\Domain\Tenant\Model\Tenant;
use App\Infrastructure\Core\Uuid\IUuid;
use Doctrine\ORM\Mapping as ORM;

abstract class BaseTenantEntity extends BaseEntity
{
    /** @ORM\Column(type="uuid_ordered_time", name="tenant_id") */
    protected IUuid $tenantId;

    /**
     * @ORM\JoinColumn(name="tenant_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected Tenant $tenant;

    public function __construct(Tenant $tenant, ?IUuid $id = null)
    {
        parent::__construct($id);

        $this->tenant = $tenant;
    }

    public function getTenantID(): string
    {
        return $this->tenantId;
    }
}