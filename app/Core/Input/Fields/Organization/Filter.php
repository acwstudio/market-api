<?php

namespace App\Core\Input\Fields\Organization;

use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\Organization\Filter\IsPublished;
use App\Core\Input\Fields\Organization\Filter\Id;
use App\Core\Input\Fields\Organization\Filter\Name;
use App\Core\Input\Fields\Organization\Filter\ParentId;
use App\Core\Input\Fields\Organization\Filter\PersonIds;
use App\Core\Input\Fields\Organization\Filter\ProductIds;
use App\Core\Input\Fields\Organization\Filter\Slug;
use App\Core\Input\Fields\Organization\Filter\Ids;
use App\Core\Input\Fields\Organization\Filter\Land;

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
     * @var Land
     */
    protected $land = null;

    /**
     * @var ParentId
     */
    protected $parent_id = null;

    /**
     * @var ProductIds
     */
    protected $product_ids = null;

    /**
     * @var PersonIds
     */
    protected $person_ids = null;

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
        Land::FIELD_KEY         => Land::class,
        ParentId::FIELD_KEY     => ParentId::class,
        ProductIds::FIELD_KEY   => ProductIds::class,
        PersonIds::FIELD_KEY    => PersonIds::class
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

    public function getLand(): Land
    {
        return $this->land;
    }

    public function getParentId(): ParentId
    {
        return $this->parent_id;
    }

    public function getProductIds(): ProductIds
    {
        return $this->product_ids;
    }

    public function getPersonIds(): PersonIds
    {
        return $this->person_ids;
    }
}
