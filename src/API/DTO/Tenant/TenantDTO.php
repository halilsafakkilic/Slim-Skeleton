<?php

namespace App\API\DTO\Tenant;

use App\API\DTO\Common\BaseDTO;
use App\Domain\Tenant\Model\Tenant;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="Tenant")
 */
class TenantDTO extends BaseDTO
{
    /**
     * @var string
     * @OA\Property()
     */
    public $name;

    public function __construct(Tenant $tenant)
    {
        $this->name = $tenant->getName();
    }
}