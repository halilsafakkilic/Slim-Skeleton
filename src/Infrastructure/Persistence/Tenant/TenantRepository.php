<?php

namespace App\Infrastructure\Persistence\Tenant;

use App\Domain\Tenant\Infrastructure\ITenantRepository;
use App\Domain\Tenant\Model\Tenant;
use App\Infrastructure\Core\Uuid\IUuid;
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
     * @param IUuid $id
     *
     * @throws ORMException
     */
    public function addRandom(IUuid $id)
    {
        $tenant = new Tenant($id);
        $tenant->setRandomName();
        $tenant->addRandomSite();

        $this->_doctrine->getEntityManager()->persist($tenant);
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