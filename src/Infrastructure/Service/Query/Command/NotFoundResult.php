<?php

namespace Infrastructure\Service\Query\Command;

class NotFoundResult implements CommandResult
{
    private string $error;

    /**
     * @param string $error
     * @param mixed ...$args
     */
    public function __construct(string $error, ...$args)
    {
        $this->error = sprintf($error, ...$args);
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function getData(): ?array
    {
        return null;
    }
}
