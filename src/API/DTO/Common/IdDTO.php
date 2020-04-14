<?php

namespace App\API\DTO\Common;

use App\Infrastructure\Core\Uuid\IUuid;

/**
 * @OA\Schema(schema="NewItem")
 */
class IdDTO extends BaseDTO
{
    /**
     * @var string
     * @OA\Property()
     */
    public $id;

    public function __construct(IUuid $uuid)
    {
        $this->id = $uuid->toString();
    }
}