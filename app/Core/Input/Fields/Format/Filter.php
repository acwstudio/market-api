<?php

namespace App\Core\Input\Fields\Format;

use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\Format\Filter\Id;
use App\Core\Input\Fields\Format\Filter\Ids;
use App\Core\Input\Fields\Format\Filter\IsPublished;
use App\Core\Input\Fields\Format\Filter\Name;
use App\Core\Input\Fields\Format\Filter\Slug;
use App\Core\Input\Fields\Format\Filter\ProductIds;

class Filter extends FieldSet implements IField
{
    const FIELD_KEY = 'filter';

    protected $fieldSetName = 'filter';

    /**
     * @var IsPublished
     */
    protected $published = null;

    /**
     * @var Id
     */
    protected $id = null;

    /**
     * @var Name
     */
    protected $name = null;

    /**
     * @var Slug
     */
    protected $slug = null;

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
        IsPublished::FIELD_KEY  => IsPublished::class,
        Id::FIELD_KEY           => Id::class,
        Name::FIELD_KEY         => Name::class,
        Slug::FIELD_KEY         => Slug::class,
        Ids::FIELD_KEY          => Ids::class,
        ProductIds::FIELD_KEY   => ProductIds::class,
    ];

    protected $requiredFields = [];

    public function getIsPublished(): IsPublished
    {
        return $this->published;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
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
