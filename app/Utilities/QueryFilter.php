<?php

namespace App\Utilities;

use Illuminate\Database\Eloquent\Builder;

class QueryFilter
{
    public static function buildQuery(array $columnMap, $request)
    {
        $operatorMap = [
            'eq' => '=',
            'ne' => '!=',
            'gt' => '>',
            'gte' => '>=',
            'lt' => '<',
            'lte' => '<=',
            'like' => 'like',
            'notLike' => 'not like',
            'in' => 'in',
            'notIn' => 'not in',
            'between' => 'between',
            'notBetween' => 'not between',
            'isNull' => 'is null',
            'isNotNull' => 'is not null'
        ];
        $result = [];

        foreach ($columnMap as $param => $column) {
            $query = $request->query($param);

            if (!$query) continue;

            foreach ($operatorMap as $operator => $sqlOperator) {
                if (isset($query[$operator])) {
                    if (in_array($operator, ['like', 'notLike'])) {
                        $result[] = [$column, $sqlOperator, '%' . $query[$operator] . '%'];
                    } elseif (in_array($operator, ['in', 'notIn'])) {
                        $values = explode(',', $query[$operator]);
                        $result[] = [$column, $sqlOperator, $values];
                    } elseif (in_array($operator, ['between', 'notBetween'])) {
                        $values = explode(',', $query[$operator]);
                        $result[] = [$column, $sqlOperator, [$values[0], $values[1]]];
                    } else {
                        $result[] = [$column, $sqlOperator, $query[$operator]];
                    }
                }
            }
        }

        return $result;
    }
}
