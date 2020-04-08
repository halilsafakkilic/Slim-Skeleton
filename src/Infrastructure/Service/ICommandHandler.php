<?php

namespace App\Infrastructure\Service;

interface ICommandHandler
{
    public function handler(object $command);
}