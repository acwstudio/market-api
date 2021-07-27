<?php

namespace App\Repositories;

use App\Core\Input\Fields\Organization\OrganizationGetDetail;
use App\Core\Input\Fields\Organization\OrganizationGetList;
use App\Models\Organization;
use App\Models\Person;
use App\Models\Product;

class OrganizationRepository
{
    public function getList(OrganizationGetList $fieldSet)
    {
        $filter = $fieldSet->getFilter();
        $sort = $fieldSet->getSort();

        $query = Organization::query();

        if (!is_null($filter->getName()->getValue())) {
            $query->where([
                Organization::FIELD_NAME => $filter->getName()->getValue()
            ]);
        }

        if (!is_null($filter->getIsPublished()->getValue())) {
            $query->where([
                Organization::FIELD_PUBLISHED => $filter->getIsPublished()->getValue()
            ]);
        }

        if (!is_null($filter->getSlug()->getValue())) {
            $query->where([
                Organization::FIELD_SLUG => $filter->getSlug()->getValue()
            ]);
        }

        $ids = $filter->getIds()->getValue();
        if (!is_null($ids) && is_array($ids)) {
            $query->whereIn(
                Organization::FIELD_ID, $ids
            );
        }

        if (!is_null($filter->getLand()->getValue())) {
            $query->where([
                Organization::FIELD_LAND => $filter->getLand()->getValue()
            ]);
        }

        if (!is_null($filter->getParentId()->getValue())) {
            $query->where([
                Organization::FIELD_PARENT_ID => $filter->getParentId()->getValue()
            ]);
        }

        $productIds = $filter->getProductIds()->getValue();
        if (!is_null($productIds) && is_array($productIds)) {
            $query->whereHas(Organization::ENTITY_RELATIVE_PRODUCT, function($subQuery) use($productIds){
                $subQuery->whereIn(Product::FIELD_ID, $productIds);
            });
        }

        $personIds = $filter->getPersonIds()->getValue();
        if (!is_null($personIds) && is_array($personIds)) {
//            $query->whereHas(Organization::ENTITY_RELATIVE_PRODUCT, function($subQuery) use($personIds){
//                $subQuery->whereHas(Product::ENTITY_RELATIVE_PERSONS, function ($subSubQuery) use($personIds){
//                    $subSubQuery->whereIn(Person::FIELD_ID, $personIds);
//                });
//            });
            $query->whereHas(Organization::ENTITY_RELATIVE_PERSONS, function($subQuery) use($personIds){
                $subQuery->whereIn(Person::FIELD_ID, $personIds);
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
            'organizations' => $query->get()
        ];
    }

    public function getDetail(OrganizationGetDetail $fieldSet){
        $filter = $fieldSet->getFilter();
        $sort = $fieldSet->getSort();

        $query = Organization::query();

        if (!is_null($filter->getId()->getValue())) {
            $query->where([
                Organization::FIELD_ID => $filter->getId()->getValue()
            ]);
        }

        if (!is_null($filter->getSlug()->getValue())) {
            $query->where([
                Organization::FIELD_SLUG => $filter->getSlug()->getValue()
            ]);
        }

        return [
            'organization' => $query->firstOrFail()
        ];
    }
}
