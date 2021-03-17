<?php

namespace Domain\User;

interface UserRepository
{
    public function save(User $user): void;
    public function findById(int $id): ?User;
}
