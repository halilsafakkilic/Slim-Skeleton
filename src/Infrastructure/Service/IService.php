<?php

namespace App\Infrastructure\Service;

interface IService
{
    public function sendQuery(IQuery $query);

    public function sendCommand(ICommand $command, bool $autoTransaction = false);
}