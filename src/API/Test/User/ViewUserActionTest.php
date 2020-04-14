<?php

namespace App\API\Test\User;

use App\API\DTO\User\UserDTO;
use App\Domain\User\Infrastructure\IUserRepository;
use App\API\Controller\ActionError;
use App\Domain\User\Model\User;
use App\Domain\User\Exception\UserNotFoundException;
use App\API\Infrastructure\ErrorHandler;
use DI\Container;
use Prophecy\PhpUnit\ProphecyTrait;
use Slim\Middleware\ErrorMiddleware;
use App\API\Test\TestCase;

class ViewUserActionTest extends TestCase
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
            ->findUserOfId(1)
            ->willReturn($user)
            ->shouldBeCalledOnce();

        $container->set(IUserRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $serializedPayload = json_encode(new UserDTO($user), JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function testActionThrowsUserNotFoundException()
    {
        $app = $this->getAppInstance();

        $callableResolver = $app->getCallableResolver();
        $responseFactory = $app->getResponseFactory();

        $errorHandler = new ErrorHandler($callableResolver, $responseFactory);
        $errorMiddleware = new ErrorMiddleware($callableResolver, $responseFactory, true, false, false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);

        $app->add($errorMiddleware);

        /** @var Container $container */
        $container = $app->getContainer();

        $userRepositoryProphecy = $this->prophesize(IUserRepository::class);
        $userRepositoryProphecy
            ->findUserOfId(1)
            ->willThrow(new UserNotFoundException())
            ->shouldBeCalledOnce();

        $container->set(IUserRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedError = new ActionError(ActionError::RESOURCE_NOT_FOUND, 'The user you requested does not exist.');
        $serializedPayload = json_encode($expectedError, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}