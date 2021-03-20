<?php

namespace Infrastructure\Service\Query;

use Infrastructure\Service\Query\Criteria\Filtering;
use Infrastructure\Service\Query\Criteria\Join;
use Infrastructure\Service\Query\Criteria\Ordering;
use Infrastructure\Service\Query\Criteria\Paginating;

class Criteria
{
    public string $resourceName;
    public Filtering $filtering;
    /** @var Join[] */
    public array $joins;
    public Ordering $ordering;
    public Paginating $paginating;

    public function __construct(
        string $resourceName,
        Filtering $filtering,
        array $joins,
        Ordering $ordering,
        Paginating $paginating
    ) {
        $this->resourceName = $resourceName;
        $this->filtering = $filtering;
        $this->joins = $joins;
        $this->ordering = $ordering;
        $this->paginating = $paginating;
    }

    public static function fromQueryParameters(string $resourceName, array $queryParameters) : self
    {
        return new self(
            $resourceName,
            Filtering::fromQueryParameters($queryParameters),
            Join::fromQueryParameters($resourceName, $queryParameters),
            Ordering::fromQueryParameters($queryParameters),
            Paginating::fromQueryParameters($queryParameters)
        );
    }
}
