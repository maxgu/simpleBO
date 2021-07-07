<?php

namespace Domain\Film;

interface FilmRepository
{
    public function save(Film $film): void;
    public function findById(int $id): ?Film;
}
