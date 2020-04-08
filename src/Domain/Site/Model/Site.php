<?php

namespace App\Domain\Site\Model;

use App\Domain\Common\BaseTenantEntity;
use App\Domain\Tenant\Model\Tenant;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Site")
 */
class Site extends BaseTenantEntity
{
    /**
     * @ORM\Column(type="string")
     */
    protected string $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Tenant\Model\Tenant", cascade={"all"}, inversedBy="sites")
     */
    protected Tenant $tenant;

    public function setRandomName()
    {
        $this->name = 'DummySite-' . uniqid();

        return $this;
    }
}