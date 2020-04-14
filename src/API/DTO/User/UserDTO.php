<?php

namespace App\API\DTO\User;

use App\API\DTO\Common\BaseDTO;
use App\Domain\User\Model\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="User")
 */
class UserDTO extends BaseDTO
{
    public function __construct(User $user)
    {
        $this->id = $user->getID();
        $this->userName = $user->getUsername();
        $this->firstName = $user->getFirstName();
        $this->lastName = $user->getLastName();
    }

    /**
     * @var string
     * @OA\Property()
     */
    public $id;

    /**
     * @var string
     * @OA\Property()
     */
    public $userName;

    /**
     * @var string
     * @OA\Property()
     */
    public $firstName;

    /**
     * @var string
     * @OA\Property()
     */
    public $lastName;
}