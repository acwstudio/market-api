<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $table = 'pages';

    const FIELD_ID = 'id',
        FIELD_NAME = 'name',
        FIELD_SLUG = 'slug',
        FIELD_PAGE_TYPE = 'page_type',
        FIELD_STATIC = 'static',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_COMPONENTS = 'components';

    public $fillable = [
        self::FIELD_NAME,
        self::FIELD_SLUG,
        self::FIELD_PAGE_TYPE,
        self::FIELD_STATIC
    ];

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getSlug()
    {
        return $this->getAttribute(self::FIELD_SLUG);
    }

    public function getPageType()
    {
        return $this->getAttribute(self::FIELD_PAGE_TYPE);
    }

    public function getStatic()
    {
        return $this->getAttribute(self::FIELD_STATIC);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function seotags()
    {
        return $this->hasOne(SeoTag::class, SeoTag::FIELD_MODEL_ID)->where(SeoTag::FIELD_MODEL, Page::class);
    }

    public function components()
    {
        return $this->belongsToMany(Component::class);
    }
}