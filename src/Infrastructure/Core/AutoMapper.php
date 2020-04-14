<?php

namespace App\Infrastructure\Core;

class AutoMapper
{
    public static function fromList(array $data, string $toClass): array
    {
        if (!$data) {
            return [];
        }

        foreach ($data as &$item) {
            $item = new $toClass($item);
        }

        return $data;
    }
}