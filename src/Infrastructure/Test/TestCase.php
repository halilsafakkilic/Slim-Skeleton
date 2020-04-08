<?php

namespace App\Infrastructure\Test;

use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use Slim\App;

class TestCase extends PHPUnit_TestCase
{
    protected function getAppInstance(): App
    {
        /** @var App $app */
        require(__DIR__ . '/../../../app/bootstrap.php');

        return $app;
    }
}