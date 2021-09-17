<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'organizations';

    const MODEL_NAME = 'Организации',
        MODEL_LINK = 'organizations';

    const FIELD_ID = 'id',
        FIELD_PUBLISHED = 'published',
        FIELD_NAME = 'name',
        FIELD_ABBREVIATION_NAME = 'abbreviation_name',
        FIELD_SLUG = 'slug',
        FIELD_LAND = 'land',
        FIELD_TYPE_TEXT = 'type_text',
        FIELD_SUBTITLE = 'subtitle',
        FIELD_DESCRIPTION = 'description',
        FIELD_HTML_BODY = 'html_body',
        FIELD_CLASSES = 'classes',
        FIELD_LOGO_CODE = 'logo_code',
        FIELD_COLOR_CODE_TITLES = 'color_code_titles',
        FIELD_ADDRESS = 'address',
        FIELD_MAP_LINK = 'map_link',
        FIELD_PREVIEW_IMAGE = 'preview_image',
        FIELD_DIGITAL_IMAGE = 'digital_image',
        FIELD_PARENT_ID = 'parent_id',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_PERSONS = 'persons',
        ENTITY_RELATIVE_PRODUCT = 'product';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_PUBLISHED,
        self::FIELD_NAME,
        self::FIELD_ABBREVIATION_NAME,
        self::FIELD_SLUG,
        self::FIELD_LAND,
        self::FIELD_PREVIEW_IMAGE,
        self::FIELD_DIGITAL_IMAGE,
        self::FIELD_SUBTITLE,
        self::FIELD_DESCRIPTION,
        self::FIELD_HTML_BODY,
        self::FIELD_CLASSES,
        self::FIELD_LOGO_CODE,
        self::FIELD_COLOR_CODE_TITLES,
        self::FIELD_ADDRESS,
        self::FIELD_MAP_LINK,
        self::FIELD_TYPE_TEXT
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

    public function getAbbreviationName()
    {
        return $this->getAttribute(self::FIELD_ABBREVIATION_NAME);
    }

    public function getSlug()
    {
        return $this->getAttribute(self::FIELD_SLUG);
    }

    public function getLand()
    {
        return $this->getAttribute(self::FIELD_LAND);
    }

    public function getSubtitle()
    {
        return $this->getAttribute(self::FIELD_SUBTITLE);
    }

    public function getDescription()
    {
        return $this->getAttribute(self::FIELD_DESCRIPTION);
    }

    public function getHtmlBody()
    {
        return $this->getAttribute(self::FIELD_HTML_BODY);
    }

    public function getClasses()
    {
        return $this->getAttribute(self::FIELD_CLASSES);
    }

    public function getLogoCode()
    {
        return $this->getAttribute(self::FIELD_LOGO_CODE);
    }

    public function getColorCodeTitles()
    {
        return $this->getAttribute(self::FIELD_COLOR_CODE_TITLES);
    }

    public function getAddress()
    {
        return $this->getAttribute(self::FIELD_ADDRESS);
    }

    public function getMapLink()
    {
        return $this->getAttribute(self::FIELD_MAP_LINK);
    }

    public function getPreviewImage()
    {
        return $this->getAttribute(self::FIELD_PREVIEW_IMAGE);
    }

    public function getPreviewImageUrl()
    {
        return Storage::url($this->getPreviewImage());
    }

    public function getDigitalImage()
    {
        return $this->getAttribute(self::FIELD_DIGITAL_IMAGE);
    }

    public function getDigitalImageUrl()
    {
        return Storage::url($this->getDigitalImage());
    }

    public function getTypeText()
    {
        return $this->getAttribute(self::FIELD_TYPE_TEXT);
    }

    public function getParentId()
    {
        return $this->getAttribute(self::FIELD_PARENT_ID);
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
        return $this->hasMany(Product::class);
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class);
    }

    public function organizationSection()
    {
        return $this->hasMany(OrganizationSection::class)->orderBy(OrganizationSection::FIELD_SORT, 'asc');
    }
}
