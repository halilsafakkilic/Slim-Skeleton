<?php

namespace App\Infrastructure\Persistence\Common\Doctrine;

use Doctrine\ORM\EntityManager;

interface IDoctrine
{
    public static function getInstance();

    public function getEntityManager(): EntityManager;
}