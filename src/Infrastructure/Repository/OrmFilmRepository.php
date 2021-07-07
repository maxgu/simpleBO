<?php

namespace Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Film\Film;
use Domain\Film\FilmRepository;

class OrmFilmRepository extends ServiceEntityRepository implements FilmRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    public function save(Film $film): void
    {
        $this->getEntityManager()->persist($film);
        $this->getEntityManager()->flush();
    }

    public function findById(int $id): ?Film
    {
        $user = $this->find($id);

        if (!$user instanceof Film) {
            return null;
        }

        return $user;
    }
}
