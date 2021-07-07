<?php

declare(strict_types=1);

namespace Domain\Film;

class Film
{
    private int $id;
    private string $name;
    private string $description;
    private string $cover;

    public function __construct(
        string $name,
        string $description,
        string $cover
    ) {
        $this->description = $description;
        $this->name = $name;
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

    public function update(
        string $name,
        string $description,
        string $cover
    ): void {
        $this->name = $name;
        $this->description = $description;
        $this->cover = $cover;
    }
}
