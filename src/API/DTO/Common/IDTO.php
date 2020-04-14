<?php

namespace App\API\DTO\Common;

interface IDTO
{
    public function jsonSerialize(): array;
}