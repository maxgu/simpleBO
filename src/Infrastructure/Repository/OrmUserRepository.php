<?php

namespace Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\User\User;
use Domain\User\UserRepository;

class OrmUserRepository extends ServiceEntityRepository implements UserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $film): void
    {
        $this->getEntityManager()->persist($film);
        $this->getEntityManager()->flush();
    }

    public function findById(int $id): ?User
    {
        $user = $this->find($id);

        if (!$user instanceof User) {
            return null;
        }

        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        $user = $this->findOneBy(['email' => $email]);

        if (!$user instanceof User) {
            return null;
        }

        return $user;
    }
}
