<?php


namespace App\Repositories;


use App\Core\Input\Fields\Format\FormatGetList;
use App\Models\Format;
use App\Models\Product;

class FormatRepository
{
    public function getList(FormatGetList $fieldSet){
        $filter = $fieldSet->getFilter();
        $sort = $fieldSet->getSort();

        $query = Format::query();

        if (!is_null($filter->getName()->getValue())) {
            $query->where([
                Format::FIELD_NAME => $filter->getName()->getValue()
            ]);
        }

        if (!is_null($filter->getIsPublished()->getValue())) {
            $query->where([
                Format::FIELD_PUBLISHED => $filter->getIsPublished()->getValue()
            ]);
        }

        if (!is_null($filter->getSlug()->getValue())) {
            $query->where([
                Format::FIELD_SLUG => $filter->getSlug()->getValue()
            ]);
        }

        $ids = $filter->getIds()->getValue();
        if (!is_null($ids) && is_array($ids)) {
            $query->whereIn(
                Format::FIELD_ID, $ids
            );
        }

        $productIds = $filter->getProductIds()->getValue();
        if (!is_null($productIds) && is_array($productIds)) {
            $query->whereHas(Format::ENTITY_RELATIVE_PRODUCT, function($subQuery) use($productIds){
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
            'formats'       => $query->get()
        ];
    }
}
