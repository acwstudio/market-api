<?php

namespace App\Repositories;

use App\Core\Input\Fields\Product\ProductGetList;
use App\Models\Product;

class ProductRepository
{
    public function getList(ProductGetList $fieldSet)
    {
        $filter = $fieldSet->getFilter();
        $pagination = $fieldSet->getPagination();
        $sort = $fieldSet->getSort();

        $query = Product::query();

        if (!is_null($filter->getName()->getValue())) {
            $query->where([
                Product::FIELD_NAME => $filter->getName()->getValue()
            ]);
        }

        if (!is_null($filter->getIsPublished()->getValue())) {
            $query->where([
                Product::FIELD_PUBLISHED => $filter->getIsPublished()->getValue()
            ]);
        }


        if (!is_null($filter->getDirections()->getValue())) {
            $values = $filter->getDirections()->getValue();
            $query->whereHas(Product::ENTITY_RELATIVE_DIRECTIONS, function ($q) use ($values) {
                $q->whereIn('id', $values);
            });
        }



        $count = $query->count();

        /**
         * Применяем сортировку
         */
        if (in_array($sort->getField()->getValue(), ['id'])) {
            $query->orderBy($sort->getField()->getValue(), $sort->getOrder()->getValue());
        }

        /**
         * Применяем пагинацию
         */
        $offset = ($pagination->getPage()->getValue() - 1) * $pagination->getPageSize()->getValue();
        if ($offset > 0) {
            $query->offset($offset);
        }
        $query->limit($pagination->getPageSize()->getValue());


        return [
            'count'    => $count,
            'products' => $query->get()
        ];
    }
}
