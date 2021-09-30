<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CityController extends Controller
{
    /**
     * @param Request $request
     * @return CityCollection
     */
    public function list(Request $request): CityCollection
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

    /**
     * @return CityResource|string
     */
    public function detail(EntityDetailRequest $request)
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
