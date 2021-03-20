<?php

namespace Infrastructure\Service\Query\Criteria;

class Filtering
{
    public array $fields;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public static function fromQueryParameters(array $queryParameters) : self
    {
        $fields = $queryParameters;
        unset($fields['limit'], $fields['offset'], $fields['sort'], $fields['join']);

        return new self($fields);
    }
}
