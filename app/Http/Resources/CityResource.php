<?php

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public static $isFilterResource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var City $city */
        $city = $this->resource;

        $ret = [
            City::FIELD_ID              => $city->id,
            'type'                      => self::$isFilterResource ? City::VALUE_TYPE : 'cities',
            City::FIELD_NAME            => $city->name,
            City::FIELD_CITY_KLADR_ID   => $city->city_kladr_id,
            City::FIELD_REGION_NAME     => $city->region_name,
            City::FIELD_REGION_KLADR_ID => $city->region_kladr_id,
            City::FIELD_GEO_POINT       => $city->geo_point,
        ];

        if (self::$isFilterResource) {
            $ret['search'] = City::VALUE_SEARCH;
        }

        return $ret;
    }
}
