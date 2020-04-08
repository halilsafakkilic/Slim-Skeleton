<?php

require_once('app/bootstrap.php');

use App\Infrastructure\Persistence\Common\Doctrine\Doctrine;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$doctrine = Doctrine::getInstance();

return ConsoleRunner::createHelperSet($doctrine->getEntityManager());