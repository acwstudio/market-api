<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\FieldTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organization
 * @package App\Models
 *
 * @property int $id
 * @property int $published
 * @property string $name
 * @property string $abbreviation_name
 * @property string $slug
 * @property int $sort
 * @property string $land
 * @property string $subtitle
 * @property string $description
 * @property string $site
 * @property string $email
 * @property string $phone
 * @property string $html_body
 * @property string $classes
 * @property string $logo_code
 * @property string $color_code_titles
 * @property string $preview_image
 * @property string $digital_image
 * @property string $address
 * @property int $is_state
 * @property int $is_military_center
 * @property int $is_hostel
 * @property int $cost_year_study
 * @property int $budget_places
 * @property int $budget_year
 * @property double $budget_points
 * @property int $contract_places
 * @property int $contract_year
 * @property double $contract_points
 * @property string $type_text
 * @property string $map_link
 * @property int $parent_id
 * @property int $city_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
final class Organization extends Model
{
    use HasFactory, SoftDeletes, FieldTrait;

    public $table = 'organizations';

    const MODEL_NAME = 'Организации',
        MODEL_LINK = 'organizations';
        
    const VALUE_SEARCH = true,
        VALUE_TYPE = 'list';

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
        FIELD_LOGO = 'logo',
        FIELD_COLOR_CODE_TITLES = 'color_code_titles',
        FIELD_ADDRESS = 'address',
        FIELD_MAP_LINK = 'map_link',
        FIELD_PREVIEW_IMAGE = 'preview_image',
        FIELD_DIGITAL_IMAGE = 'digital_image',
        FIELD_PARENT_ID = 'parent_id',
        FIELD_CITY_ID = 'city_id',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_PERSONS = 'persons',
        ENTITY_RELATIVE_PRODUCTS = 'products',
        ENTITY_RELATIVE_CITY = 'city';

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
        self::FIELD_TYPE_TEXT,
        self::FIELD_CITY_ID
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function persons(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function entitySection(): HasMany
    {
        return $this->hasMany(EntitySection::class, 'entity_id')
            ->where(EntitySection::FIELD_ENTITY_TYPE, 'App\\Models\\Organization')
            ->orderBy(EntitySection::FIELD_SORT, 'asc');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function seotags(): HasOne
    {
        return $this->hasOne(SeoTag::class, SeoTag::FIELD_MODEL_ID)
            ->where(SeoTag::FIELD_MODEL, Organization::class);
    }
}
