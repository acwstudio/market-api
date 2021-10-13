<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Landing extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'landings';

    const MODEL_NAME = 'Лендинги',
        MODEL_LINK = 'landings';

    const FIELD_ID = 'id',
        FIELD_NAME = 'name',
        FIELD_SLUG = 'slug',
        FIELD_DESCRIPTION = 'description',
        FIELD_COLOR_BG = 'color_bg',
        FIELD_IMAGE_SRC = 'image_src',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_FORMATS = 'formats',
        ENTITY_RELATIVE_LEVELS = 'levels',
        ENTITY_RELATIVE_DIRECTIONS = 'directions',
        ENTITY_RELATIVE_CITIES = 'cities',
        ENTITY_RELATIVE_ORGANIZATIONS = 'organizations',
        ENTITY_RELATIVE_FORMAT = 'format',
        ENTITY_RELATIVE_LEVEL = 'level',
        ENTITY_RELATIVE_DIRECTION = 'direction',
        ENTITY_RELATIVE_CITY = 'city',
        ENTITY_RELATIVE_ORGANIZATION = 'organization',
        ENTITY_RELATIVE_LANDINGABLE = 'landingable';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_SLUG,
        self::FIELD_DESCRIPTION,
        self::FIELD_COLOR_BG,
        self::FIELD_IMAGE_SRC,
        self::FIELD_CREATED_AT,
        self::FIELD_UPDATED_AT
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

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getSlug()
    {
        return $this->getAttribute(self::FIELD_SLUG);
    }

    public function getDescription()
    {
        return $this->getAttribute(self::FIELD_DESCRIPTION);
    }

    public function getColorBg()
    {
        return $this->getAttribute(self::FIELD_COLOR_BG);
    }

    public function getImageSrc()
    {
        return $this->getAttribute(self::FIELD_IMAGE_SRC);
    }

    public function getImageSrcUrl()
    {
        return Storage::url($this->getImageSrc());
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function formats()
    {
        return $this->morphedByMany(Format::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }

    public function levels()
    {
        return $this->morphedByMany(Level::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }

    public function directions()
    {
        return $this->morphedByMany(Direction::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }

    public function cities()
    {
        return $this->morphedByMany(City::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }

    public function organizations()
    {
        return $this->morphedByMany(Organization::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }
}
