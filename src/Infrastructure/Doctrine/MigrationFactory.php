<?php

namespace Infrastructure\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\Migrations\AbstractMigration;
use Psr\Log\LoggerInterface;
use Doctrine\Migrations\Version\MigrationFactory as DoctrineMigrationFactory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MigrationFactory implements DoctrineMigrationFactory
{
    private Connection $connection;
    private LoggerInterface $logger;
    private ContainerInterface $container;

    public function __construct(
        Connection $connection,
        LoggerInterface $logger,
        ContainerInterface $container
    ) {
        $this->connection = $connection;
        $this->logger     = $logger;
        $this->container = $container;
    }

    public function createVersion(string $migrationClassName) : AbstractMigration
    {
        $migration = new $migrationClassName(
            $this->connection,
            $this->logger
        );

        // or you can ommit this check
        if ($migration instanceof ContainerAwareInterface) {
            $migration->setContainer($this->container);
        }

        return $migration;
    }
}