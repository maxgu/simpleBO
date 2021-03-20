<?php

namespace Infrastructure\Service\Query\Criteria;

class Join
{
    public string $fromAlias;
    public string $join;
    public string $alias;
    public ?string $condition = null;

    private static array $rules = [
        'sports' => [
            'sport_vendor_id' => ['sport_vendor_id', 'sport_vendor_id', 'sports.id = sport_vendor_id.sport_id'],
        ],
        'markets' => [
            'markets_vendor_id' => ['markets_vendor_id', 'markets_vendor_id', 'markets.id = markets_vendor_id.market_id'],
        ],
    ];

    public function __construct(string $fromAlias, string $join, string $alias, ?string $condition)
    {
        $this->fromAlias = $fromAlias;
        $this->join = $join;
        $this->alias = $alias;
        $this->condition = $condition;
    }

    /**
     * @param string $resourceName
     * @param array $queryParameters
     * @return Join[]
     */
    public static function fromQueryParameters(string $resourceName, array $queryParameters) : array
    {
        $relations = $queryParameters['join'] ?? [];

        $joins = [];
        foreach ($relations as $relation) {
            if (isset(self::$rules[$resourceName][$relation])) {
                $joins[] = new Join($resourceName, ...self::$rules[$resourceName][$relation]);
            }
        }

        return $joins;
    }
}
