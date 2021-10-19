<?php

declare(strict_types=1);

namespace App\Repositories\City;

use App\Http\Requests\City\DetailRequest;
use App\Http\Requests\City\ListRequest;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Models\City;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CityRepository implements CityRepositoryInterface
{
    private City $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function getCitiesByFilters(ListRequest $request): CityCollection
    {
        $query = QueryBuilder::for(City::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', City::FIELD_ID),
                AllowedFilter::exact(City::FIELD_NAME),
                AllowedFilter::exact(City::FIELD_REGION_NAME),
                AllowedFilter::exact(City::FIELD_CITY_KLADR_ID),
                AllowedFilter::exact(City::FIELD_REGION_KLADR_ID),
                AllowedFilter::exact(City::FIELD_GEO_POINT)
            ])
            ->allowedSorts([City::FIELD_ID, City::FIELD_NAME])
            ->get();

        return (new CityCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    public function getCityDetailByFilters(DetailRequest $request): CityResource
    {
        $query = QueryBuilder::for(City::class)
            ->allowedFilters([
                AllowedFilter::exact(City::FIELD_ID)
            ])
            ->firstOrFail();

        return (new CityResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
