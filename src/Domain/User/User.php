<?php

declare(strict_types=1);

namespace Domain\User;

class User
{
    private int $id;
    private string $email;
    private string $name;
    private string $password;

    public function __construct(
        string $email,
        string $name,
        string $password
    ) {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
