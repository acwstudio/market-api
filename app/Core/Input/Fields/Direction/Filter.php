<?php

namespace App\Core\Input\Fields\Direction;

use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\Direction\Filter\Ids;
use App\Core\Input\Fields\Direction\Filter\IsPublished;
use App\Core\Input\Fields\Direction\Filter\Name;
use App\Core\Input\Fields\Direction\Filter\ProductIds;
use App\Core\Input\Fields\Direction\Filter\ShowMain;
use App\Core\Input\Fields\Direction\Filter\Slug;

class Filter extends FieldSet implements IField
{
    const FIELD_KEY = 'filter';

    protected $fieldSetName = 'filter';

    /**
     * @var IsPublished
     */
    protected $published = null;

    /**
     * @var Name
     */
    protected $name = null;

    /**
     * @var Slug
     */
    protected $slug = null;

    /**
     * @var ShowMain
     */
    protected $show_main = null;

    /**
     * @var Ids
     */
    protected $ids = null;

    /**
     * @var ProductIds
     */
    protected $product_ids = null;

    /**
     * Очень внимательно вписываем тут названия полей
     * @var string[] Fields этого набора
     */
    protected $fields = [
        IsPublished::FIELD_KEY => IsPublished::class,
        Name::FIELD_KEY        => Name::class,
        Slug::FIELD_KEY        => Slug::class,
        ShowMain::FIELD_KEY    => ShowMain::class,
        Ids::FIELD_KEY         => Ids::class,
        ProductIds::FIELD_KEY  => ProductIds::class,
    ];

    protected $requiredFields = [

    ];

    /**
     * @return IsPublished
     */
    public function getIsPublished(): IsPublished
    {
        return $this->published;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getShowMain(): ShowMain
    {
        return $this->show_main;
    }

    public function getIds(): Ids
    {
        return $this->ids;
    }

    public function getProductIds(): ProductIds
    {
        return $this->product_ids;
    }
}
