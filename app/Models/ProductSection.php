<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSection extends Model
{
    use HasFactory;

    public $table = 'product_section';

    const FIELD_PRODUCT_ID = 'product_id',
        FIELD_SECTION_ID = 'section_id',
        FIELD_PUBLISHED = 'published',
        FIELD_TITLE = 'title',
        FIELD_ANCHOR_TITLE = 'anchor_title',
        FIELD_IS_HIDE_ANCHOR = 'is_hide_anchor',
        FIELD_SORT = 'sort',
        FIELD_JSON = 'json',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    protected $fillable = [
        self::FIELD_PRODUCT_ID,
        self::FIELD_SECTION_ID,
        self::FIELD_PUBLISHED,
        self::FIELD_TITLE,
        self::FIELD_SORT,
        self::FIELD_JSON,
    ];

    public function getPublished()
    {
        return $this->getAttribute(self::FIELD_PUBLISHED);
    }

    public function getProductId()
    {
        return $this->getAttribute(self::FIELD_PRODUCT_ID);
    }

    public function getSectionId()
    {
        return $this->getAttribute(self::FIELD_SECTION_ID);
    }

    public function getTitle()
    {
        return $this->getAttribute(self::FIELD_TITLE);
    }

    public function getAnchorTitle()
    {
        return $this->getAttribute(self::FIELD_ANCHOR_TITLE);
    }

    public function getIsHideAnchor()
    {
        return $this->getAttribute(self::FIELD_IS_HIDE_ANCHOR);
    }

    public function getSort()
    {
        return $this->getAttribute(self::FIELD_SORT);
    }

    public function getJson()
    {
        return $this->getAttribute(self::FIELD_JSON);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function section()
    {
        return $this->hasOne(Section::class, Section::FIELD_ID, self::FIELD_SECTION_ID);
    }
}
