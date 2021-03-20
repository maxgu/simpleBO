<?php

namespace Infrastructure\Service\Query\Criteria;

class Ordering
{
    private const DEFAULT_FIELD = 'id';
    private const DEFAULT_DIRECTION = 'ASC';

    public string $field;
    public string $direction;

    public function __construct(string $field, string $direction)
    {
        $this->field = $field;
        $this->direction = $direction;
    }

    public static function fromQueryParameters(array $queryParameters) : self
    {
        $column = $queryParameters['sort'] ?? self::DEFAULT_FIELD;
        $direction = self::DEFAULT_DIRECTION;
        if ('-' === $column[0]) {
            $direction = 'DESC';
            $column = trim($column, '-');
        }

        return new self($column, $direction);
    }
}
