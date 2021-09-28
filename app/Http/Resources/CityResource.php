<?php

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
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

        return [
            City::FIELD_ID              => $city->getId(),
            'type'                      => 'cities',
            City::FIELD_NAME            => $city->getName(),
            City::FIELD_CITY_KLADR_ID   => $city->getCityKladrId(),
            City::FIELD_REGION_NAME     => $city->getRegionName(),
            City::FIELD_REGION_KLADR_ID => $city->getRegionKladrId(),
            City::FIELD_GEO_POINT       => $city->getGeoPoint(),
        ];
    }
}
