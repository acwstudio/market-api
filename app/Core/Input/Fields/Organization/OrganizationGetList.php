<?php

namespace App\Core\Input\Fields\Organization;

use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\DataProvider\Sort;
use App\Core\Input\Fields\Organization\Filter;

class OrganizationGetList extends FieldSet implements IField
{
    const FIELD_KEY = 'organization_get_list';

    protected $fieldSetName = 'organization_get_list';

    /**
     * @var Filter
     */
    protected $filter = null;

    /**
     * @var Sort
     */
    protected $sort = null;

    /**
     * Очень внимательно вписываем тут названия полей
     * @var string[] Fields этого набора
     */
    protected $fields = [
        Filter::FIELD_KEY     => Filter::class,
        Sort::FIELD_KEY       => Sort::class
    ];

    protected $requiredFields = [

    ];

    /**
     * @return Filter
     */
    public function getFilter(): Filter
    {
        return $this->filter;
    }

    /**
     * @return Sort
     */
    public function getSort(): Sort
    {
        return $this->sort;
    }
}
