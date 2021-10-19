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
            City::FIELD_ID              => $city->getId(),
            'type'                      => self::$isFilterResource ? City::VALUE_TYPE : 'cities',
            City::FIELD_NAME            => $city->getName(),
            City::FIELD_CITY_KLADR_ID   => $city->getCityKladrId(),
            City::FIELD_REGION_NAME     => $city->getRegionName(),
            City::FIELD_REGION_KLADR_ID => $city->getRegionKladrId(),
            City::FIELD_GEO_POINT       => $city->getGeoPoint(),
        ];
        
        if (self::$isFilterResource) {
            $ret['search'] = City::VALUE_SEARCH;
        }
        
        return $ret;
    }
}
