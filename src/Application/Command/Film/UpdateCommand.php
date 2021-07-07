<?php

namespace Application\Command\Film;

class UpdateCommand
{
    private int $id;
    private string $name;
    private string $description;
    private string $cover;

    public function __construct(int $id, string $name, string $description, string $cover)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->cover = $cover;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCover(): string
    {
        return $this->cover;
    }
}