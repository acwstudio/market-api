<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        FIELD_REGION_NAME = 'region_name',
        FIELD_CITY_KLADR_ID = 'city_kladr_id',
        FIELD_REGION_KLADR_ID = 'region_kladr_id',
        FIELD_GEO_POINT = 'geo_point',
        FIELD_CREATED_AT = 'created_at',
        FIELD_UPDATED_AT = 'updated_at';

    public $fillable = [
        self::FIELD_ID,
        self::FIELD_NAME,
        self::FIELD_REGION_NAME,
        self::FIELD_CITY_KLADR_ID,
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

    public function getId()
    {
        return $this->getAttribute(self::FIELD_ID);
    }

    public function getName()
    {
        return $this->getAttribute(self::FIELD_NAME);
    }

    public function getRegionName()
    {
        return $this->getAttribute(self::FIELD_REGION_NAME);
    }

    public function getCityKladrId()
    {
        return $this->getAttribute(self::FIELD_CITY_KLADR_ID);
    }

    public function getRegionKladrId()
    {
        return $this->getAttribute(self::FIELD_REGION_KLADR_ID);
    }

    public function getGeoPoint()
    {
        return $this->getAttribute(self::FIELD_GEO_POINT);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::FIELD_CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getAttribute(self::FIELD_UPDATED_AT);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }
}
