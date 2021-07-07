<?php

namespace Application\Command\Film;

use Domain\Film\Film;
use Domain\Film\FilmRepository;

class UpdateHandler
{
    private FilmRepository $repository;

    private ?string $error = null;

    public function __construct(FilmRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(UpdateCommand $command): bool
    {
        $film = $this->repository->findById($command->getId());

        if ($film === null) {
            $this->error = sprintf(
                'Film #%d not found.',
                $command->getId(),
            );
            return false;
        }

        $film->update(
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
