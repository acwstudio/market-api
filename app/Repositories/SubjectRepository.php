<?php


namespace App\Repositories;

use App\Core\Input\Fields\Subject\SubjectGetList;
use App\Models\Product;
use App\Models\Subject;

class SubjectRepository
{
    public function getList(SubjectGetList $fieldSet){
        $filter = $fieldSet->getFilter();
        $sort = $fieldSet->getSort();

        $query = Subject::query();

        if (!is_null($filter->getName()->getValue())) {
            $query->where([
                Subject::FIELD_NAME => $filter->getName()->getValue()
            ]);
        }

        if (!is_null($filter->getIsPublished()->getValue())) {
            $query->where([
                Subject::FIELD_PUBLISHED => $filter->getIsPublished()->getValue()
            ]);
        }

        if (!is_null($filter->getSlug()->getValue())) {
            $query->where([
                Subject::FIELD_SLUG => $filter->getSlug()->getValue()
            ]);
        }

        $ids = $filter->getIds()->getValue();
        if (!is_null($ids) && is_array($ids)) {
            $query->whereIn(
                Subject::FIELD_ID, $ids
            );
        }

        $productIds = $filter->getProductIds()->getValue();
        if (!is_null($productIds) && is_array($productIds)) {
            $query->whereHas(Subject::ENTITY_RELATIVE_PRODUCT, function($subQuery) use($productIds){
                $subQuery->whereIn(Product::FIELD_ID, $productIds);
            });
        }

        $count = $query->count();

        /**
         * Применяем сортировку
         */
        if (!is_null($sort->getField()->getValue())) {
            $query->orderBy($sort->getField()->getValue(), $sort->getOrder()->getValue());
        }

        return [
            'count'         => $count,
            'subjects'      => $query->get()
        ];
    }
}
