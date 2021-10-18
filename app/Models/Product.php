<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\Search\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 *
 * @property int $id
 * @property int $is_moderated
 * @property string $land
 * @property int $published
 * @property string $expiration_date
 * @property string $name
 * @property string $slug
 * @property int $sort
 * @property string $preview_image
 * @property string $digital_image
 * @property double $price
 * @property string $start_date
 * @property int $is_employment
 * @property int $is_installment
 * @property int $installment_months
 * @property int $is_document
 * @property int $document
 * @property string $triggers
 * @property string $begin_duration
 * @property string $begin_duration_format_value
 * @property int $duration
 * @property string $duration_format_value
 * @property string $description
 * @property string $color
 * @property int $organization_id
 * @property int $category_id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property Person $persons
 * @property Organization $organization
 * @property Level $levels
 * @property Direction $directions
 * @property Format $formats
 */
final class Product extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    public $table = 'products';

    const MODEL_NAME = 'Продукты',
        MODEL_LINK = 'products';

    const FIELD_ID = 'id',
        FIELD_IS_MODERATED = 'is_moderated',
        FIELD_PUBLISHED = 'published',
        FIELD_EXPIRATION_DATE = 'expiration_date',
        FIELD_NAME = 'name',
        FIELD_SORT = 'sort',
        FIELD_SLUG = 'slug',
        FIELD_PREVIEW_IMAGE = 'preview_image',
        FIELD_DIGITAL_IMAGE = 'digital_image',
        FIELD_LAND = 'land',
        FIELD_PRICE = 'price',

        FIELD_START_DATE = 'start_date',
        FIELD_IS_EMPLOYMENT = 'is_employment',
        FIELD_IS_INSTALLMENT = 'is_installment',
        FIELD_INSTALLMENT_MONTHS = 'installment_months',
        FIELD_BEGIN_DURATION = 'begin_duration',
        FIELD_BEGIN_DURATION_FORMAT_VALUE = 'begin_duration_format_value',
        FIELD_DURATION = 'duration',
        FIELD_DURATION_FORMAT_VALUE = 'duration_format_value',

        FIELD_IS_DOCUMENT = 'is_document',
        FIELD_DOCUMENT = 'document',
        FIELD_TRIGGERS = 'triggers',

        FIELD_COLOR = 'color',
        FIELD_DESCRIPTION = 'description',
        FIELD_ORGANIZATION_ID = 'organization_id',
        FIELD_THEME_ID = 'theme_id',
        FIELD_CATEGORY_ID = 'category_id',
        FIELD_USER_ID = 'user_id',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    const ENTITY_RELATIVE_DIRECTIONS = 'directions',
        ENTITY_RELATIVE_LEVELS = 'levels',
        ENTITY_RELATIVE_FORMATS = 'formats',
        ENTITY_RELATIVE_SUBJECTS = 'subjects',
        ENTITY_RELATIVE_PERSONS = 'persons',
        ENTITY_PRODUCT_SECTION = 'productsection',
        ENTITY_RELATIVE_ORGANIZATION = 'organization',
        ENTITY_RELATIVE_CITY = 'city',
        ENTITY_RELATIVE_PRODUCT_PLACES = 'productplaces',
        ENTITY_RELATIVE_PRODUCTABLES = 'productables';

    protected $fillable = [
        self::FIELD_IS_MODERATED,
        self::FIELD_NAME,
        self::FIELD_PUBLISHED,
        self::FIELD_NAME,
        self::FIELD_SLUG,
        self::FIELD_PREVIEW_IMAGE,
        self::FIELD_DIGITAL_IMAGE,
        self::FIELD_LAND,
        self::FIELD_PRICE,
        self::FIELD_START_DATE,
        self::FIELD_EXPIRATION_DATE,
        self::FIELD_IS_EMPLOYMENT,
        self::FIELD_IS_INSTALLMENT,
        self::FIELD_INSTALLMENT_MONTHS,
        self::FIELD_IS_DOCUMENT,
        self::FIELD_DOCUMENT,
        self::FIELD_TRIGGERS,
        self::FIELD_BEGIN_DURATION,
        self::FIELD_BEGIN_DURATION_FORMAT_VALUE,
        self::FIELD_DURATION,
        self::FIELD_DURATION_FORMAT_VALUE,
        self::FIELD_DESCRIPTION,
        self::FIELD_COLOR,
        self::FIELD_ORGANIZATION_ID,
        self::FIELD_THEME_ID,
        self::FIELD_CATEGORY_ID,
        self::FIELD_USER_ID,
        self::FIELD_CREATED_AT,
        self::FIELD_UPDATED_AT,
    ];

    public function getField($fieldKey)
    {
        return $this->getAttribute($fieldKey);
    }

    public function subjects(): MorphToMany
    {
        return $this->morphedByMany(Subject::class, 'productable');
    }

    public function formats(): MorphToMany
    {
        return $this->morphedByMany(Format::class, 'productable');
    }

    public function levels(): MorphToMany
    {
        return $this->morphedByMany(Level::class, 'productable');
    }

    public function directions(): MorphToMany
    {
        return $this->morphedByMany(Direction::class, 'productable');
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class);
    }

    public function persons(): MorphToMany
    {
        return $this->morphedByMany(Person::class, 'productable');
    }

    public function entitySection(): HasMany
    {
        return $this->hasMany(EntitySection::class, 'entity_id')
            ->where(EntitySection::FIELD_ENTITY_TYPE, 'App\\Models\\Product')
            ->orderBy(EntitySection::FIELD_SORT, 'asc');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function seotags(): HasOne
    {
        return $this->hasOne(SeoTag::class, SeoTag::FIELD_MODEL_ID)->where(SeoTag::FIELD_MODEL, Product::class);
    }

    public function productplaces(): MorphToMany
    {
        return $this->morphedByMany(ProductPlace::class, 'productable');
    }

    public function toSearchArray(): array
    {
        $attributes = $this->getAttributes();

        return \Arr::only($attributes, ['name', 'description']);
    }
}
