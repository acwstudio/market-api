<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Section extends Model
{
    use HasFactory;

    public $table = 'sections';

    const GROUP_PRODUCT = 1,
        GROUP_ORGANIZATION = 2;

    const MODEL_NAME = 'Секции',
        MODEL_LINK = 'sections';

    const FIELD_ID = 'id',
        FIELD_PUBLISHED = 'published',
        FIELD_NAME = 'name',
        FIELD_IS_GLOBAL = 'is_global',
        FIELD_CONFIG_KEY = 'config_key',
        FIELD_API_KEY = 'api_key',
        FIELD_PREVIEW_IMAGE = 'preview_image',
        FIELD_GROUP = 'group',
        FIELD_JSON_TEMPLATE = 'json_template',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_PUBLISHED,
        self::FIELD_NAME,
        self::FIELD_CONFIG_KEY,
        self::FIELD_API_KEY,
        self::FIELD_PREVIEW_IMAGE,
        self::FIELD_GROUP
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

    public function getJsonTemplate()
    {
        return $this->getAttribute(self::FIELD_JSON_TEMPLATE);
    }

    public function getIsGlobal()
    {
        return $this->getAttribute(self::FIELD_IS_GLOBAL);
    }

    public function getConfigKey()
    {
        return $this->getAttribute(self::FIELD_CONFIG_KEY);
    }

    public function getApiKey()
    {
        return $this->getAttribute(self::FIELD_API_KEY);
    }

    public function getPreviewImage()
    {
        return $this->getAttribute(self::FIELD_PREVIEW_IMAGE);
    }

    public function getPreviewImageUrl()
    {
        return Storage::url($this->getPreviewImage());
    }

    public function getGroup()
    {
        return $this->getAttribute(self::FIELD_GROUP);
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
        return $this->belongsToMany(Product::class);
    }
}
