<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package App\Models
 *
 * @property int $id
 * @property string $country
 * @property string $name
 * @property string $region_name
 * @property string $city_kladr_id
 * @property string $region_kladr_id
 * @property string $geoname_id
 * @property string $geo_point
 * @property string $updated_at
 * @property string $deleted_at
 */
class City extends Model
{
    use HasFactory;

    public $table = 'cities';

    const MODEL_NAME = 'Города',
        MODEL_LINK = 'cities';

    const VALUE_SEARCH = true,
        VALUE_TYPE = 'list';

    const FIELD_ID = 'id',
        FIELD_NAME = 'name',
        FIELD_COUNTRY = 'country',
        FIELD_REGION_NAME = 'region_name',
        FIELD_CITY_KLADR_ID = 'city_kladr_id',
        FIELD_REGION_KLADR_ID = 'region_kladr_id',
        FIELD_GEONAME_ID = 'geoname_id',
        FIELD_GEO_POINT = 'geo_point',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_NAME,
        self::FIELD_COUNTRY,
        self::FIELD_REGION_NAME,
        self::FIELD_CITY_KLADR_ID,
        self::FIELD_GEONAME_ID,
        self::FIELD_REGION_KLADR_ID,
        self::FIELD_GEO_POINT
    ];

    public static function getModelName()
    {
        return self::MODEL_NAME;
    }

    public static function getModelLink()
    {
        return self::MODEL_LINK;
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }
}
