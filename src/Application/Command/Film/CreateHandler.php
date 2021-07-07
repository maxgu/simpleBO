<?php

namespace Application\Command\Film;

use Domain\Film\Film;
use Domain\Film\FilmRepository;

class CreateHandler
{
    private FilmRepository $repository;

    private ?string $error = null;

    public function __construct(FilmRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CreateCommand $command): bool
    {
        $film = new Film(
            $command->getName(),
            $command->getDescription(),
            $command->getCover()
        );

        $this->repository->save($film);

        return true;
    }

    public function getError(): ?string
    {
        return $this->error;
    }
}
