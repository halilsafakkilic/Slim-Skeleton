<?php

namespace App\Infrastructure\Service;

interface IQueryHandler
{
    public function handler(object $query);
}