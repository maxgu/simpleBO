<?php

namespace Application\Command\User;

use Application\Service\PasswordEncoder;
use Domain\User\UserRepository;
use Domain\User\User;

class CreateHandler
{
    private UserRepository $repository;
    private PasswordEncoder $passwordEncoder;

    private ?string $error = null;

    public function __construct(UserRepository $repository, PasswordEncoder $passwordEncoder)
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function handle(CreateCommand $command): bool
    {
        $user = $this->repository->findByEmail($command->getEmail());

        if ($user instanceof User) {
            $this->error = sprintf(
                'User with email %s already exists.',
                $command->getEmail(),
            );
            return false;
        }

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
        return $this->error;
    }
}
