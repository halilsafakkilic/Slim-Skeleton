<?php

namespace App\API\Controller\Tenant;

use App\API\Controller\Action;
use App\API\DTO\Common\IdDTO;
use App\Infrastructure\Core\Uuid\Uuid;
use App\Service\Tenant\Command\AddTenant\AddTenantCommand;
use Psr\Http\Message\ResponseInterface as Response;

class AddTenantAction extends Action
{
    protected function handle(): Response
    {
        $addTenantCommand = new AddTenantCommand();
        $addTenantCommand->id = Uuid::generate();

        $this->service->sendCommand($addTenantCommand);

        $this->logger->info("Tenant added.");

        return $this->respond(new IdDTO($addTenantCommand->id));
    }
}