<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'products';

    const MODEL_NAME = 'Продукты',
        MODEL_LINK = 'products';

    const IS_EXPIRATION_DATE = 'is_expiration_date';

    const FIELD_ID = 'id',
        FIELD_IS_MODERATED = 'is_moderated',
        FIELD_PUBLISHED = 'published',
        FIELD_EXPIRATION_DATE = 'expiration_date',
        FIELD_NAME = 'name',
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
        ENTITY_RELATIVE_LEVELS       = 'levels',
        ENTITY_RELATIVE_FORMATS      = 'formats',
        ENTITY_RELATIVE_SUBJECTS     = 'subjects',
        ENTITY_RELATIVE_PERSONS      = 'persons',
        ENTITY_PRODUCT_SECTION       = 'productsection',
        ENTITY_RELATIVE_ORGANIZATION = 'organization';

    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    const DATE_TIME_DISPLAY_FORMAT = 'd.m.Y H:i';

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

    public function getIsModerated()
    {
        return $this->getAttribute(self::FIELD_IS_MODERATED);
    }

    public function getPublished()
    {
        return $this->getAttribute(self::FIELD_PUBLISHED);
    }

    public function getExpirationDate()
    {
        if ($this->getAttribute(self::FIELD_EXPIRATION_DATE)) {
            return Carbon::parse($this->getAttribute(self::FIELD_EXPIRATION_DATE))->format(self::DATE_TIME_DISPLAY_FORMAT);
        }

        return null;
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getSlug()
    {
        return $this->getAttribute(self::FIELD_SLUG);
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

    public function getLand()
    {
        return $this->getAttribute(self::FIELD_LAND);
    }

    public function getPrice()
    {
        return $this->getAttribute(self::FIELD_PRICE);
    }

    public function getStartDate()
    {
        if ($this->getAttribute(self::FIELD_START_DATE)) {
            return Carbon::parse($this->getAttribute(self::FIELD_START_DATE))->format(self::DATE_TIME_DISPLAY_FORMAT);
        }

        return null;
    }

    public function getIsInstallment()
    {
        return $this->getAttribute(self::FIELD_IS_INSTALLMENT);
    }

    public function getInstallmentMonths()
    {
        return $this->getAttribute(self::FIELD_INSTALLMENT_MONTHS);
    }

    public function getBeginDuration()
    {
        return $this->getAttribute(self::FIELD_BEGIN_DURATION);
    }

    public function getBeginDurationFormatValue()
    {
        return $this->getAttribute(self::FIELD_BEGIN_DURATION_FORMAT_VALUE);
    }

    public function getDuration()
    {
        return $this->getAttribute(self::FIELD_DURATION);
    }

    public function getDurationFormatValue()
    {
        return $this->getAttribute(self::FIELD_DURATION_FORMAT_VALUE);
    }

    public function getDurationSiteDisplay()
    {
        $duration = $this->getDurationFormatValue();

        if (!$duration) {
            return null;
        }

        $durationList = explode('-', $duration);

        $display = [];
        foreach ($durationList as $itemDuration) {

            $type = strtolower(preg_replace('/[^a-zA-Z]/', '', $itemDuration));
            $value = preg_replace('/[^0-9]/', '', $itemDuration);

            if ($type == 'y') {
                $display[] = trans_choice(':count год|:count года|:count лет', $value, ['count' => $value]);
            }

            if ($type == 'm') {
                $display[] = trans_choice(':count месяц|:count месяца|:count месяцев', $value, ['count' => $value]);
            }

            if ($type == 'd') {
                $display[] = trans_choice(':count день|:count дня|:count дней', $value, ['count' => $value]);
            }

            if ($type == 'h') {
                $display[] = trans_choice(':count час|:count часа|:count часов', $value, ['count' => $value]);
            }
        }

        return implode(' ', $display);
    }

    public function getIsEmployment()
    {
        return $this->getAttribute(self::FIELD_IS_EMPLOYMENT);
    }

    public function getIsDocument()
    {
        return $this->getAttribute(self::FIELD_IS_DOCUMENT);
    }

    public function getDocument()
    {
        return $this->getAttribute(self::FIELD_DOCUMENT);
    }

    public function getTriggers()
    {
        return $this->getAttribute(self::FIELD_TRIGGERS);
    }

    public function getTriggersArray()
    {
        return explode('|', $this->getTriggers());
    }

    public function getDescription()
    {
        return $this->getAttribute(self::FIELD_DESCRIPTION);
    }

    public function getColor()
    {
        return $this->getAttribute(self::FIELD_COLOR);
    }

    public function getOrganizationId()
    {
        return $this->getAttribute(self::FIELD_ORGANIZATION_ID);
    }

    public function getCategoryId()
    {
        return $this->getAttribute(self::FIELD_CATEGORY_ID);
    }

    public function getUserId()
    {
        return $this->getAttribute(self::FIELD_USER_ID);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function subjects()
    {
        return $this->morphedByMany(Subject::class, 'productable');
    }

    public function formats()
    {
        return $this->morphedByMany(Format::class, 'productable');
    }

    public function levels()
    {
        return $this->morphedByMany(Level::class, 'productable');
    }

    public function directions()
    {
        return $this->morphedByMany(Direction::class, 'productable');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class);
    }

    public function entitySection()
    {
        return  $this->hasMany(EntitySection::class, 'entity_id')
            ->where(EntitySection::FIELD_ENTITY_TYPE, 'App\\Models\\Product')
            ->orderBy(EntitySection::FIELD_SORT, 'asc');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
