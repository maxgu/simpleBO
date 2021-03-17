<?php

namespace Application\Command\User;

use Application\Service\PasswordEncoder;
use Domain\User\UserRepository;
use Domain\User\User;

class CreateHandler
{
    private UserRepository $repository;
    private PasswordEncoder $passwordEncoder;

    public function __construct(UserRepository $repository, PasswordEncoder $passwordEncoder)
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function handle(CreateCommand $command): bool
    {
        $user = new User(
            $command->getEmail(),
            $command->getName(),
            $this->passwordEncoder->encodePassword($command->getPassword())
        );

        $this->repository->save($user);

        return true;
    }

    public function getError(): ?string
    {
        return null;
    }
}
