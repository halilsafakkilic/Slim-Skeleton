<?php

namespace App\API\DTO\Common;

abstract class BaseDTO implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        $output = [];
        foreach ($this as $key => $val) {
            $output[$key] = $val;
        }

        return $output;
    }
}