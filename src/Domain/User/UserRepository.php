<?php

namespace Domain\User;

interface UserRepository
{
    public function save(User $film): void;
    public function findById(int $id): ?User;
    public function findByEmail(string $email): ?User;
}
