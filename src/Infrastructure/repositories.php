<?php

use App\Domain\Tenant\Infrastructure\ITenantRepository;
use App\Domain\User\Infrastructure\IUserRepository;
use App\Infrastructure\Persistence\Common\Doctrine\Doctrine;
use App\Infrastructure\Persistence\Common\Doctrine\IDoctrine;
use App\Infrastructure\Persistence\Tenant\TenantRepository;
use App\Infrastructure\Persistence\User\UserRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function(ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        IUserRepository::class => autowire(UserRepository::class),
    ]);

    $containerBuilder->addDefinitions([
        IDoctrine::class => Doctrine::getInstance(),
    ]);

    $containerBuilder->addDefinitions([
        ITenantRepository::class => autowire(TenantRepository::class),
    ]);
};