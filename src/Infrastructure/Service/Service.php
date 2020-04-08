<?php

namespace App\Infrastructure\Service;

use App\Infrastructure\Persistence\Common\Doctrine\IDoctrine;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use InvalidArgumentException;
use Psr\Container\ContainerInterface;
use Throwable;
use function DI\get;

class Service implements IService
{
    private static self              $_instance;
    private ContainerInterface       $_container;
    private IDoctrine                $_doctrine;

    public function __construct(ContainerInterface $container, IDoctrine $doctrine)
    {
        self::$_instance = $this;

        $this->_container = $container;
        $this->_doctrine = $doctrine;
    }

    public function sendQuery(IQuery $query)
    {
        $result = $this->_queryHandler(get_class($query));

        return $result->handler($query);
    }

    /**
     * @param ICommand $command
     * @param bool     $autoTransaction
     *
     * @return mixed
     * @throws ConnectionException
     * @throws Throwable
     */
    public function sendCommand(ICommand $command, bool $autoTransaction = false)
    {
        $instance = $this->_commandHandler(get_class($command));

        // Np Transaction
        if (!$autoTransaction) {
            return $this->_sendCommandByNoTransaction($command, $instance);
        }

        // Auto Transaction
        return $this->_sendCommandByTransaction($command, $instance);

    }

    /**
     * @param ICommand        $command
     * @param ICommandHandler $instance
     *
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function _sendCommandByNoTransaction(ICommand $command, ICommandHandler $instance)
    {
        $result = $instance->handler($command);

        $this->_doctrine->getEntityManager()->flush();

        return $result;
    }

    /**
     * @param ICommand        $command
     * @param ICommandHandler $instance
     *
     * @return mixed
     * @throws ConnectionException
     * @throws Throwable
     */
    private function _sendCommandByTransaction(ICommand $command, ICommandHandler $instance)
    {
        if (!method_exists($instance, 'useTransaction')) {
            throw new InvalidArgumentException('This command use transaction feature not allowed.');
        }

        try {
            $this->_doctrine->getEntityManager()->getConnection()->beginTransaction();

            $response = $instance->handler($command);

            $this->_doctrine->getEntityManager()->flush();

            $this->_doctrine->getEntityManager()->getConnection()->commit();

            return $response;
        } catch (Throwable $e) {
            $this->_doctrine->getEntityManager()->getConnection()->rollBack();

            throw $e;
        }
    }

    private function _commandHandler(string $handler): ICommandHandler
    {
        return $this->_handler($handler);
    }

    private function _queryHandler(string $handler): IQueryHandler
    {
        return $this->_handler($handler);
    }

    private function _handler(string $handler)
    {
        $handler .= 'Handler';

        if (!class_exists($handler)) {
            throw new InvalidArgumentException($handler . ' not found!');
        }

        $instance = get($handler);

        return $instance->resolve($this->_container);
    }
}