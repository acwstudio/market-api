<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Landing extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'landings';

    const FIELD_ID = 'id',
        FIELD_NAME = 'name',
        FIELD_SLUG = 'slug',
        FIELD_DESCRIPTION = 'description',
        FIELD_COLOR_BG = 'color_bg',
        FIELD_IMAGE_SRC = 'image_src',
        FIELD_IS_ALL_FORMS = 'is_all_forms',
        FIELD_IS_ALL_LEVELS = 'is_all_levels',
        FIELD_IS_ALL_DIRECTIONS = 'is_all_directions',
        FIELD_IS_ALL_CITIES = 'is_all_cities',
        FIELD_IS_ALL_ORGANIZATIONS = 'is_all_organizations',
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
        self::FIELD_IS_ALL_FORMS,
        self::FIELD_IS_ALL_LEVELS,
        self::FIELD_IS_ALL_DIRECTIONS,
        self::FIELD_IS_ALL_CITIES,
        self::FIELD_IS_ALL_ORGANIZATIONS,
        self::FIELD_CREATED_AT,
        self::FIELD_UPDATED_AT,
    ];

    public function formats(): MorphToMany
    {
        return $this->morphedByMany(Format::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }

    public function levels(): MorphToMany
    {
        return $this->morphedByMany(Level::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }

    public function directions(): MorphToMany
    {
        return $this->morphedByMany(Direction::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }

    public function cities(): MorphToMany
    {
        return $this->morphedByMany(City::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }

    public function organizations(): MorphToMany
    {
        return $this->morphedByMany(Organization::class, self::ENTITY_RELATIVE_LANDINGABLE);
    }
}
