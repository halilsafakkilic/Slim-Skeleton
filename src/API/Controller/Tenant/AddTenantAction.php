<?php

namespace App\API\Controller\Tenant;

use App\API\Controller\Action;
use App\Domain\Tenant\Model\Tenant;
use App\Service\Tenant\Command\AddTenant\AddTenantCommand;
use Psr\Http\Message\ResponseInterface as Response;

class AddTenantAction extends Action
{
    protected function handle(): Response
    {
        $addTenantCommand = new AddTenantCommand();

        /** @var string $tenantId */
        $tenantId = $this->service->sendCommand($addTenantCommand);

        $this->logger->info("Tenant added.");

        return $this->respondWithData(['id' => $tenantId]);
    }
}