<?php

namespace App\Domain\User\Model;

use App\Domain\Common\BaseEntity;
use App\Infrastructure\Core\Uuid\IUuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Tenant")
 */
class User extends BaseEntity
{
    /**
     * @ORM\Column(type="string")
     */
    private string $username;

    /**
     * @ORM\Column(type="string", name="first_name")
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", name="last_name")
     */
    private $lastName;

    /**
     * User constructor.
     *
     * @param string     $username
     * @param string     $firstName
     * @param string     $lastName
     * @param IUuid|null $id
     */
    public function __construct(string $username, string $firstName, string $lastName, ?IUuid $id = null)
    {
        parent::__construct($id);

        $this->username = strtolower($username);
        $this->firstName = ucfirst($firstName);
        $this->lastName = ucfirst($lastName);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
}