<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Infrastructure\Security\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class Version20210314115856 extends AbstractMigration  implements ContainerAwareInterface
{
    private ?ContainerInterface $container;

    public function setContainer(ContainerInterface $container = null): void
    {
        $this->container = $container;
    }

    public function getDescription() : string
    {
        return 'create table users';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql(
            'CREATE TABLE users (
                id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                email VARCHAR(100) NOT NULL,
                password VARCHAR(255) NOT NULL,
                name VARCHAR(60) NOT NULL,
                PRIMARY KEY(id),
                UNIQUE (email)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $encoder = $this->container->get('security.password_encoder');

        $user = new User('admin@mail.com', 'Admin');
        $password = $encoder->encodePassword($user, '123456');

        $this->addSql(sprintf(
            'INSERT INTO users (email, password, name)'
            . ' VALUES ("%s", "%s", "%s")',
            $user->getUsername(),
            $password,
            $user->getName()
        ));
    }

    public function down(Schema $schema) : void
    {

    }
}
