<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Format extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'formats';

    const MODEL_NAME = 'Форматы обучения',
        MODEL_LINK = 'formats';

    const FILTER_BY = 'format_ids';

    const VALUE_SEARCH = false,
        VALUE_TYPE = 'list';

    const FIELD_ID = 'id',
        FIELD_PUBLISHED = 'published',
        FIELD_NAME = 'name',
        FIELD_SLUG = 'slug',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at',
        FIELD_DELETED_AT = 'deleted_at';

    public $fillable = [
        self::FIELD_PUBLISHED,
        self::FIELD_NAME,
        self::FIELD_SLUG
    ];

    const ENTITY_RELATIVE_PRODUCT = 'products';

    public static function getModelName()
    {
        return self::MODEL_NAME;
    }

    public static function getModelLink()
    {
        return self::MODEL_LINK;
    }

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getPublished()
    {
        return $this->getAttribute(self::FIELD_PUBLISHED);
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getSlug()
    {
        return $this->getAttribute(self::FIELD_SLUG);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function getFilterBy()
    {
        return self::FILTER_BY;
    }

    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }

}
