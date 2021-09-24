<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'banners';

    const MODEL_NAME = 'Баннеры',
        MODEL_LINK = 'banners';

    public const BANNER_TYPES = [
        'top',
        'narrow',
        'side'
    ];

    public const COLOR_BG_LIST_VALUES = [
        'accent', 'primary', 'secondary', 'none', 'custom'
    ];
    public const COLOR_TEXT_LIST_VALUES = [
        'default', 'custom'
    ];


    const FIELD_ID = 'id',
        FIELD_PUBLISHED = 'published',
        FIELD_NAME = 'name',
        FIELD_LINK = 'link',
        FIELD_BANNER_TYPE = 'banner_type',
        FIELD_COLOR_BG = 'color_bg',
        FIELD_COLOR_TEXT = 'color_text',
        FIELD_COLOR_BG_LIST = 'color_bg_list',
        FIELD_COLOR_TEXT_LIST = 'color_text_list',
        FIELD_NAME_SECOND = 'name_second',
        FIELD_DESCRIPTION = 'description',
        FIELD_IMAGE = 'image',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_PUBLISHED,
        self::FIELD_NAME,
        self::FIELD_LINK,
        self::FIELD_BANNER_TYPE,
        self::FIELD_DESCRIPTION,
        self::FIELD_COLOR_BG,
        self::FIELD_COLOR_TEXT,
        self::FIELD_NAME_SECOND,
        self::FIELD_IMAGE
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

    public function getLink()
    {
        return $this->getAttribute(self::FIELD_LINK);
    }

    public function getBannerType()
    {
        return $this->getAttribute(self::FIELD_BANNER_TYPE);
    }

    public function getColorBg()
    {
        return $this->getAttribute(self::FIELD_COLOR_BG);
    }

    public function getColorText()
    {
        return $this->getAttribute(self::FIELD_COLOR_TEXT);
    }

    public function getColorBgList()
    {
        return $this->getAttribute(self::FIELD_COLOR_BG_LIST);
    }

    public function getColorTextList()
    {
        return $this->getAttribute(self::FIELD_COLOR_TEXT_LIST);
    }

    public function getNameSecond()
    {
        return $this->getAttribute(self::FIELD_NAME_SECOND);
    }

    public function getDescription()
    {
        return $this->getAttribute(self::FIELD_DESCRIPTION);
    }

    public function getImage()
    {
        return $this->getAttribute(self::FIELD_IMAGE);
    }

    public function getImageUrl()
    {
        return Storage::url($this->getImage());
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }
}
