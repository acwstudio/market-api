<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'persons';

    const MODEL_NAME = 'Персоны',
        MODEL_LINK = 'persons';

    const FIELD_ID = 'id',
        FIELD_PUBLISHED = 'published',
        FIELD_NAME = 'name',
        FIELD_POSITION = 'position',
        FIELD_SHOW_MAIN = 'show_main',
        FIELD_DESCRIPTION = 'description',
        FIELD_PREVIEW_IMAGE = 'preview_image',
        FIELD_DELETED_AT = 'deleted_at',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_PRODUCTS = 'products';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_PUBLISHED,
        self::FIELD_NAME,
        self::FIELD_POSITION,
        self::FIELD_SHOW_MAIN,
        self::FIELD_DESCRIPTION,
        self::FIELD_PREVIEW_IMAGE
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

    public function getPosition()
    {
        return $this->getAttribute(self::FIELD_POSITION);
    }

    public function getShowMain()
    {
        return $this->getAttribute(self::FIELD_SHOW_MAIN);
    }

    public function getDescription()
    {
        return $this->getAttribute(self::FIELD_DESCRIPTION);
    }

    public function getPreviewImage()
    {
        return $this->getAttribute(self::FIELD_PREVIEW_IMAGE);
    }

    public function getPreviewImageUrl()
    {
        return Storage::url($this->getPreviewImage());
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

//    public function products()
//    {
//        return $this->belongsToMany(Product::class);
//    }

    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }
}
