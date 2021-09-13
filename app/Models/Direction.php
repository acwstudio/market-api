<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Direction extends Model
{
    use HasFactory;

    public $table = 'directions';

    const MODEL_NAME = 'Направления',
        MODEL_LINK = 'directions';

    const FIELD_ID = 'id',
        FIELD_PUBLISHED = 'published',
        FIELD_NAME = 'name',
        FIELD_SHOW_MAIN = 'show_main',
        FIELD_SORT = 'sort',
        FIELD_PREVIEW_IMAGE = 'preview_image',
        FIELD_SLUG = 'slug',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_PRODUCT = 'products';

    public $fillable = [
        self::FIELD_PUBLISHED,
        self::FIELD_NAME,
        self::FIELD_SHOW_MAIN,
        self::FIELD_SORT,
        self::FIELD_PREVIEW_IMAGE,
        self::FIELD_SLUG
    ];

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

    public function getShowMain()
    {
        return $this->getAttribute(self::FIELD_SHOW_MAIN);
    }

    public function getSort()
    {
        return $this->getAttribute(self::FIELD_SORT);
    }

    public function getPreviewImage()
    {
        return $this->getAttribute(self::FIELD_PREVIEW_IMAGE);
    }

    public function getPreviewImageUrl()
    {
        return Storage::url($this->getPreviewImage());
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

    public function products()
    {
//        return $this->belongsToMany(Product::class);
        return $this->morphMany(Product::class, 'productable');
    }

}
