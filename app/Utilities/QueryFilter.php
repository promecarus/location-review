<?php

namespace App\Utilities;

use Illuminate\Database\Eloquent\Builder;

class QueryFilter
{
    public static function buildQuery(array $params, $request)
    {
        $operatorMap = [
            'eq' => '=',
            'ne' => '!=',
            'gt' => '>',
            'gte' => '>=',
            'lt' => '<',
            'lte' => '<=',
            'like' => 'like',
            'not_like' => 'not like',
            'in' => 'in',
            'not_in' => 'not in',
            'between' => 'between',
            'not_between' => 'not between',
            'is_null' => 'is null',
            'is_not_null' => 'is not null'
        ];
        $result = [];

        foreach ($params as $param) {
            $query = $request->query($param);

            if (!$query) continue;

            foreach ($operatorMap as $operator => $sqlOperator) {
                if ($request->has("$param.$operator")) {
                    $value = $request->input("$param.$operator");
                    if (in_array($operator, ['like', 'not_like'])) {
                        $value = "%$value%";
                    } elseif (in_array($operator, ['in', 'not_in'])) {
                        $value = explode(',', $value);
                    } elseif (in_array($operator, ['between', 'not_between'])) {
                        $value = explode(',', $value);
                        $value = [$value[0], $value[1]];
                    }
                    $result[] = [$param, $sqlOperator, $value];
                }
            }
        }

        return $result;
    }
}
