<?php

namespace Infrastructure\Service\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use Infrastructure\Service\Query\Criteria\Ordering;
use Infrastructure\Service\Query\Criteria\Paginating;

class DoctrineResult implements Result
{
    private QueryBuilder $queryBuilder;
    private Paginating $pager;
    private Ordering $order;

    public function __construct(QueryBuilder $queryBuilder, Paginating $pager, Ordering $order)
    {
        $this->queryBuilder = $queryBuilder;
        $this->pager = $pager;
        $this->order = $order;
    }

    public function takeFirst(): array
    {
        $queryBuilder = clone $this->queryBuilder;
        $queryBuilder->setFirstResult(0);
        $queryBuilder->setMaxResults(1);
        // @phpstan-ignore-next-line
        return $queryBuilder->execute()->fetchAssociative() ?: [];
    }

    public function take(int $offset, int $limit): array
    {
        $queryBuilder = clone $this->queryBuilder;
        $queryBuilder->orderBy(
            $this->order->field,
            $this->order->direction
        );
        $queryBuilder->setFirstResult($offset);
        $queryBuilder->setMaxResults($limit);
        // @phpstan-ignore-next-line
        return $queryBuilder->execute()->fetchAllAssociative();
    }

    public function takeByPager(): array
    {
        // @phpstan-ignore-next-line
        return $this->take($this->pager->offset, $this->pager->limit);
    }

    public function getPagerData(): array
    {
        return [
            'page' => $this->pager->currentPage,
            'limit' => $this->pager->limit,
            'count' => $this->count()
        ];
    }

    public function count(): int
    {
        $queryBuilder = clone $this->queryBuilder;
        $queryBuilder->select('count(*) AS count');
        $result = $queryBuilder->execute()->fetchAssociative();
        // @phpstan-ignore-next-line
        return $result['count'] ?? 0;
    }
}
