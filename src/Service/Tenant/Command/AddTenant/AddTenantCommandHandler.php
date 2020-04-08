<?php

namespace App\Service\Tenant\Command\AddTenant;

use App\Domain\Tenant\Infrastructure\ITenantRepository;
use App\Infrastructure\Persistence\Common\Doctrine\IDoctrine;
use App\Infrastructure\Service\ICommandHandler;

class AddTenantCommandHandler implements ICommandHandler
{
    private IDoctrine         $_doctrine;
    private ITenantRepository $_repository;

    /**
     * AddTenantCommandHandler constructor.
     *
     * @param IDoctrine         $doctrine
     * @param ITenantRepository $repository
     */
    public function __construct(IDoctrine $doctrine, ITenantRepository $repository)
    {
        $this->_doctrine = $doctrine;
        $this->_repository = $repository;
    }

    /**
     * @param AddTenantCommand $command
     *
     * @return string
     */
    public function handler($command)
    {
        return $this->_repository->addRandom();
    }
}