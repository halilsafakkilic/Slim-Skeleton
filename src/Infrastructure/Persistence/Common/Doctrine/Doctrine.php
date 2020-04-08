<?php

namespace App\Infrastructure\Persistence\Common\Doctrine;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

class Doctrine implements IDoctrine
{
    /**
     * @var Doctrine
     */
    private static               $_instance;
    private static EntityManager $_em;

    /**
     * Doctrine constructor.
     *
     * @throws AnnotationException
     * @throws DBALException
     * @throws ORMException
     */
    private function __construct()
    {
        $domainDir = APP_DIR . '/src/Domain';

        $paths = [
            $domainDir . '/Tenant/Model',
            $domainDir . '/Site/Model',
        ];

        $isDevMode = true;

        $dbParams = [
            'driver'   => 'pdo_mysql',
            'host'     => '172.17.0.1:8989',
            'user'     => 'root',
            'password' => 'root',
            'dbname'   => 'test',
        ];

        $reader = new AnnotationReader();
        $driver = new AnnotationDriver($reader, $paths);

        Type::addType('uuid_ordered_time', UuidType::class);

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $config->setMetadataDriverImpl($driver);

        self::$_em = EntityManager::create($dbParams, $config);

        # Debug
        if (defined('DOCTRINE_DEBUG') && DOCTRINE_DEBUG) {
            self::$_em->getConnection()
                ->getConfiguration()
                ->setSQLLogger(new EchoSQLLogger());
        }

        self::$_instance = $this;
    }

    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getEntityManager(): EntityManager
    {
        return self::$_em;
    }
}