<?php

namespace Infrastructure\Service\Query\Criteria;

class Paginating
{
    private const DEFAULT_LIMIT = 20;

    public int $currentPage;
    public int $limit;
    public int $offset;

    public function __construct(int $limit, int $offset)
    {
        $this->currentPage = (int)floor(($offset / $limit) + 1);
        $this->limit = $limit;
        if ($this->limit <= 0) {
            $this->limit = self::DEFAULT_LIMIT;
        }
        $this->offset = $offset;
    }

    public static function fromQueryParameters(array $queryParameters) : self
    {
        $queryParameters['limit'] = $queryParameters['limit'] ?? self::DEFAULT_LIMIT;
        $queryParameters['offset'] = $queryParameters['offset'] ?? 0;

        return new self($queryParameters['limit'], $queryParameters['offset']);
    }
}
