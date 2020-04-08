<?php

namespace App\Service\Tenant\Query\GetTenant;

use App\Domain\Tenant\Infrastructure\ITenantRepository;
use App\Domain\Tenant\Model\Tenant;
use App\Infrastructure\Service\IQueryHandler;

class GetTenantQueryHandler implements IQueryHandler
{
    private ITenantRepository $_repository;

    public function __construct(ITenantRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @param object $query
     *
     * @return Tenant|null
     */
    public function handler($query)
    {
        return $this->_repository->findByID($query->id);
    }
}