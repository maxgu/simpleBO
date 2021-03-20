<?php

namespace Infrastructure\Service\Query;

/**
 * Central abstraction for paginatable results.
 */
interface Result
{
    /**
     * @return mixed
     */
    public function takeFirst();
    public function take(int $offset, int $limit): array;
    public function takeByPager(): array;
    public function getPagerData(): array;
    public function count(): int;
}
