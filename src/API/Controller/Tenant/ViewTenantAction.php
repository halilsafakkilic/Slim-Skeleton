<?php

namespace App\API\Controller\Tenant;

use App\API\Controller\Action;
use App\Domain\Tenant\Model\Tenant;
use App\Service\Tenant\Query\GetTenant\GetTenantQuery;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class ViewTenantAction extends Action
{
    private const ERROR_NOT_FOUND = 'User not found!';

    /**
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    protected function handle(): Response
    {
        $id = $this->resolveArg('id');
        if (!$id) {
            throw new HttpNotFoundException($this->request, self::ERROR_NOT_FOUND);
        }

        $getTenantQuery = new GetTenantQuery();
        $getTenantQuery->id = $id;

        /** @var Tenant|null $tenant */
        $tenant = $this->service->sendQuery($getTenantQuery);
        if (!$tenant) {
            throw new HttpNotFoundException($this->request, self::ERROR_NOT_FOUND);
        }

        $this->logger->info("Tenant of id `'{$id}` was viewed.");

        return $this->respondWithData(['name' => $tenant->getName()]);
    }
}