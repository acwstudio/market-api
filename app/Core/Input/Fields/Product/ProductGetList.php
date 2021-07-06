<?php

namespace App\Core\Input\Fields\Product;

use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\DataProvider\Pagination;
use App\Core\Input\Fields\DataProvider\Sort;

class ProductGetList extends FieldSet implements IField
{
    const FIELD_KEY = 'product_get_list';

    protected $fieldSetName = 'product_get_list';

    /**
     * @var Filter
     */
    protected $filter = null;

    /**
     * @var Pagination
     */
    protected $pagination = null;

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
        Sort::FIELD_KEY       => Sort::class,
        Pagination::FIELD_KEY => Pagination::class,
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

    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
}