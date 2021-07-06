<?php

namespace App\Core\Input\Fields\DataProvider;

use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\DataProvider\Pagination\Page;
use App\Core\Input\Fields\DataProvider\Pagination\PageSize;

class Pagination extends FieldSet implements IField
{
    const FIELD_KEY = 'pagination';

    protected $fieldSetName = 'pagination';

    /**
     * @var Page
     */
    protected $page = null;

    /**
     * @var PageSize
     */
    protected $page_size = null;

    /**
     * Очень внимательно вписываем тут названия полей
     * @var string[] Fields этого набора
     */
    protected $fields = [
        Page::FIELD_KEY => Page::class,
        PageSize::FIELD_KEY => PageSize::class
    ];

    /**
     * Значения по умолчанию
     * @var int[]
     */
    protected $defaultValues = [
        Page::FIELD_KEY => 1,
        PageSize::FIELD_KEY => 20
    ];

    protected $requiredFields = [

    ];

    /**
     * @return Page
     */
    public function getPage(): Page
    {
        return $this->page;
    }

    /**
     * @return PageSize
     */
    public function getPageSize(): PageSize
    {
        return $this->page_size;
    }


}
