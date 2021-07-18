<?php

namespace App\Repositories;

use App\Core\Input\Fields\Product\ProductGetList;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Level;
use App\Models\Organization;
use App\Models\Person;
use App\Models\Product;
use App\Models\Subject;
use Carbon\Carbon;

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

        if (!is_null($filter->getExpirationDateTime()->getValue())) {
            $query->where([
                Product::FIELD_EXPIRATION_DATE => date('Y-m-d H:i:s', strtotime($filter->getExpirationDateTime()->getValue()))
            ]);
        }

        if (!is_null($filter->getIsPublished()->getValue())) {
            $query->where([
                Product::FIELD_PUBLISHED => $filter->getIsPublished()->getValue()
            ]);
        }

        $ids = $filter->getIds()->getValue();
        if (!is_null($ids) && is_array($ids)) {
            $query->whereIn(Product::FIELD_ID, $ids);
        }

        if (!is_null($filter->getIsDocument()->getValue())) {
            $query->where([
                Product::FIELD_DOCUMENT => $filter->getIsDocument()->getValue()
            ]);
        }

        if (!is_null($filter->getIsInstallment()->getValue())) {
            $query->where([
                Product::FIELD_IS_INSTALLMENT => $filter->getIsInstallment()->getValue()
            ]);
        }

        if (!is_null($filter->getIsEmployment()->getValue())) {
            $query->where([
                Product::FIELD_IS_EMPLOYMENT => $filter->getIsEmployment()->getValue()
            ]);
        }

        $organizationIds = $filter->getOrganizationIds()->getValue();
        if (!is_null($organizationIds) && is_array($organizationIds)) {
            $query->whereHas(Product::ENTITY_RELATIVE_ORGANIZATION, function ($subQuery) use ($organizationIds) {
                $subQuery->whereIn(Organization::FIELD_ID, $organizationIds);
            });
        }

        $subjectIds = $filter->getSubjectIds()->getValue();
        if (!is_null($subjectIds) && is_array($subjectIds)) {
            $query->whereHas(Product::ENTITY_RELATIVE_SUBJECTS, function ($subQuery) use ($subjectIds) {
                $subQuery->whereIn(Subject::FIELD_ID, $subjectIds);
            });
        }

        $formatIds = $filter->getFormatIds()->getValue();
        if (!is_null($formatIds) && is_array($formatIds)) {
            $query->whereHas(Product::ENTITY_RELATIVE_FORMATS, function ($subQuery) use ($formatIds) {
                $subQuery->whereIn(Format::FIELD_ID, $formatIds);
            });
        }

        $levelIds = $filter->getLevelIds()->getValue();
        if (!is_null($levelIds) && is_array($levelIds)) {
            $query->whereHas(Product::ENTITY_RELATIVE_LEVELS, function ($subQuery) use ($levelIds) {
                $subQuery->whereIn(Level::FIELD_ID, $levelIds);
            });
        }

        $directionIds = $filter->getDirectionIds()->getValue();
        if (!is_null($directionIds) && is_array($directionIds)) {
            $query->whereHas(Product::ENTITY_RELATIVE_DIRECTIONS, function ($subQuery) use ($directionIds) {
                $subQuery->whereIn(Direction::FIELD_ID, $directionIds);
            });
        }

        $personIds = $filter->getPersonIds()->getValue();
        if (!is_null($personIds) && is_array($personIds)) {
            $query->whereHas(Product::ENTITY_RELATIVE_PERSONS, function ($subQuery) use ($personIds) {
                $subQuery->whereIn(Person::FIELD_ID, $personIds);
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
            'count' => $count,
            'products' => $query->get()
        ];
    }
}
