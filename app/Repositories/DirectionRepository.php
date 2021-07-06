<?php

namespace App\Repositories;

use App\Core\Input\Fields\Direction\DirectionGetList;
use App\Models\Direction;

class DirectionRepository
{
    public function getList(DirectionGetList $fieldSet)
    {
        $filter = $fieldSet->getFilter();
        $sort = $fieldSet->getSort();

        $query = Direction::query();

        if (!is_null($filter->getName()->getValue())) {
            $query->where([
                Direction::FIELD_NAME => $filter->getName()->getValue()
            ]);
        }

        if (!is_null($filter->getIsPublished()->getValue())) {
            $query->where([
                Direction::FIELD_PUBLISHED => $filter->getIsPublished()->getValue()
            ]);
        }

        if (!is_null($filter->getSlug()->getValue())) {
            $query->where([
                Direction::FIELD_SLUG => $filter->getSlug()->getValue()
            ]);
        }


        $count = $query->count();



        /**
         * Применяем сортировку
         */
        if (!is_null($sort->getField()->getValue())) {
            $query->orderBy($sort->getField()->getValue(), $sort->getOrder()->getValue());
        }


        return [
            'count'    => $count,
            'directions' => $query->get()
        ];
    }
}
