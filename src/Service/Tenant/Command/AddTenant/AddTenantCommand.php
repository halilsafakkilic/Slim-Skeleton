<?php

namespace App\Service\Tenant\Command\AddTenant;

use App\Infrastructure\Core\Uuid\IUuid;
use App\Infrastructure\Service\ICommand;

class AddTenantCommand implements ICommand
{
    public IUuid $id;
}