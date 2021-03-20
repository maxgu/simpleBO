<?php

namespace Infrastructure\Service\Query\Command;

interface CommandResult
{
    public function getError(): ?string;
    public function getData(): ?array;
}
