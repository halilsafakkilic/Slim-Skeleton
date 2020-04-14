<?php

namespace App\Domain\Tenant\Model;

use App\Domain\Common\BaseEntity;
use App\Domain\Site\Model\Site;
use App\Infrastructure\Core\Uuid\IUuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="Tenant")
 */
class Tenant extends BaseEntity
{
    /**
     * @ORM\Column(type="string")
     */
    protected string $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Site\Model\Site", mappedBy="tenant", fetch="LAZY", cascade={"persist"})
     * @var ArrayCollection|PersistentCollection
     */
    protected $sites;

    public function __construct(?IUuid $id = null)
    {
        parent::__construct($id);

        $this->sites = new ArrayCollection();
    }

    public function getName()
    {
        return $this->name;
    }

    public function setRandomName()
    {
        $this->name = 'DummyTenant-' . uniqid();

        return $this;
    }

    public function addRandomSite()
    {
        $site = new Site($this);
        $site->setRandomName();

        $this->sites[] = $site;

        return $this;
    }

    /**
     * @return Site[]
     */
    public function getSites(): array
    {
        return $this->sites->getValues();
    }
}