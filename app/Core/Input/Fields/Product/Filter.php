<?php

namespace App\Core\Input\Fields\Product;

use App\Core\FieldSet;
use App\Core\IField;
use App\Core\Input\Fields\Product\Filter\Directions;
use App\Core\Input\Fields\Product\Filter\IsPublished;
use App\Core\Input\Fields\Product\Filter\Name;
use App\Core\Input\Fields\Product\Filter\Slug;

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
     * @var Directions
     */
    protected $directions = null;

    /**
     * Очень внимательно вписываем тут названия полей
     * @var string[] Fields этого набора
     */
    protected $fields = [
        IsPublished::FIELD_KEY => IsPublished::class,
        Name::FIELD_KEY        => Name::class,
        Slug::FIELD_KEY        => Slug::class,
        Directions::FIELD_KEY  => Directions::class,
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

    public function getDirections(): Directions
    {
        return $this->directions;
    }
}