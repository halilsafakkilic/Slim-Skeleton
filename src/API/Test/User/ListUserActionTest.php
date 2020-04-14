<?php

namespace App\API\Test\User;

use App\API\DTO\User\UserDTO;
use App\Domain\User\Infrastructure\IUserRepository;
use App\Domain\User\Model\User;
use App\Infrastructure\Core\AutoMapper;
use DI\Container;
use App\API\Test\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class ListUserActionTest extends TestCase
{
    use ProphecyTrait;

    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $user = new User('bill.gates', 'Bill', 'Gates');

        $userRepositoryProphecy = $this->prophesize(IUserRepository::class);
        $userRepositoryProphecy
            ->findAll()
            ->willReturn([$user])
            ->shouldBeCalledOnce();

        $container->set(IUserRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $serializedPayload = json_encode(AutoMapper::fromList([$user], UserDTO::class), JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}