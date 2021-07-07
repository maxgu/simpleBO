<?php

namespace Application\Command\Film;

class CreateCommand
{
    private string $name;
    private string $description;
    private string $cover;

    public function __construct(string $name, string $description, string $cover)
    {
        $this->name = $name;
        $this->description = $description;
        $this->cover = $cover;
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