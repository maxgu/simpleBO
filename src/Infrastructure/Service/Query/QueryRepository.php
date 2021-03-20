<?php

namespace Infrastructure\Service\Query;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class QueryRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findOneBy(Criteria $criteria, array $columns = ['*']): array
    {
        return $this->findBy($criteria, $columns)->takeFirst();
    }

    public function findBy(Criteria $criteria, array $columns = ['*']): Result
    {
        $queryBuilder = new QueryBuilder($this->connection);
        $queryBuilder->select(...$columns);
        $queryBuilder->from($criteria->resourceName);

        foreach($criteria->joins as $join) {
            $queryBuilder->join($join->fromAlias, $join->join, $join->alias, $join->condition);
        }

        foreach ($criteria->filtering->fields as $name => $value) {
            if ($this->processSpecialCase($name, $value, $queryBuilder)) {
                continue;
            }

            list($field, $comparison) = explode('_', $name);

            $this->assertComparison($comparison);

            if (in_array($comparison, ['isNull', 'isNotNull'])) {
                $queryBuilder->andWhere($queryBuilder->expr()->{$comparison}($field));
                continue;
            }

            $queryBuilder->andWhere($queryBuilder->expr()->{$comparison}($field, $value));
        }

        return new DoctrineResult($queryBuilder, $criteria->paginating, $criteria->ordering);
    }

    /**
     * @param string $fieldName
     * @param string|int $value
     * @param QueryBuilder $queryBuilder
     * @return bool
     */
    protected function processSpecialCase(string $fieldName, $value, QueryBuilder $queryBuilder): bool
    {
        // you can override it in child
        return false;
    }

    protected function assertComparison(string $comparison): void
    {
        if (empty($comparison)) {
            throw new \RuntimeException('Comparison can not be empty');
        }

        $comparisons = [
            'eq', 'neq', 'lt', 'lte', 'gt', 'gte', 'isNull', 'isNotNull', 'like', 'notLike', 'in', 'notIn'
        ];

        if (!in_array($comparison, $comparisons)) {
            throw new \RuntimeException('Bad comparison: ' . $comparison);
        }
    }
}
