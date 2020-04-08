<?php

namespace App\Infrastructure\Persistence\Tenant;

use App\Domain\Tenant\Infrastructure\ITenantRepository;
use App\Domain\Tenant\Model\Tenant;
use App\Infrastructure\Persistence\Common\Doctrine\IDoctrine;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;

class TenantRepository implements ITenantRepository
{
    private IDoctrine $_doctrine;

    public function __construct(IDoctrine $doctrine)
    {
        $this->_doctrine = $doctrine;
    }

    /**
     * @return string
     * @throws ORMException
     */
    public function addRandom(): string
    {
        $tenant = new Tenant();
        $tenant->setRandomName();
        $tenant->addRandomSite();

        $this->_doctrine->getEntityManager()->persist($tenant);

        return $tenant->getID();
    }

    /**
     * @param string $id
     *
     * @return Tenant|null
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     */
    public function findByID(string $id): ?Tenant
    {
        return $this->_doctrine->getEntityManager()->find(Tenant::class, $id);
    }
}