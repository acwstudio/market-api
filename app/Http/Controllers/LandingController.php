<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\LandingCollection;
use App\Http\Resources\LandingResource;
use App\Models\City;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Landing;
use App\Models\Level;
use App\Models\Organization;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LandingController extends Controller
{
    /**
     * @param Request $request
     * @return LandingCollection
     */
    public function list(Request $request): LandingCollection
    {
        $query = QueryBuilder::for(Landing::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', Landing::FIELD_ID),
                AllowedFilter::exact(Landing::FIELD_NAME),
                AllowedFilter::exact(Landing::FIELD_SLUG),
                AllowedFilter::exact(Landing::FIELD_DESCRIPTION),
                AllowedFilter::exact(Landing::FIELD_COLOR_BG),
                AllowedFilter::exact('format_ids', implode('.', [Landing::ENTITY_RELATIVE_FORMATS, Format::FIELD_ID])),
                AllowedFilter::exact('level_ids', implode('.', [Landing::ENTITY_RELATIVE_LEVELS, Level::FIELD_ID])),
                AllowedFilter::exact('direction_ids', implode('.', [Landing::ENTITY_RELATIVE_DIRECTIONS, Direction::FIELD_ID])),
                AllowedFilter::exact('city_ids', implode('.', [Landing::ENTITY_RELATIVE_CITIES, City::FIELD_ID])),
                AllowedFilter::exact('organization_ids', implode('.', [Landing::ENTITY_RELATIVE_ORGANIZATIONS, Organization::FIELD_ID]))
            ])
            ->allowedIncludes([
                Landing::ENTITY_RELATIVE_FORMATS,
                Landing::ENTITY_RELATIVE_LEVELS,
                Landing::ENTITY_RELATIVE_DIRECTIONS,
                Landing::ENTITY_RELATIVE_CITIES,
                Landing::ENTITY_RELATIVE_ORGANIZATIONS
            ])
            ->allowedSorts([Landing::FIELD_NAME, Landing::FIELD_ID])
            ->get();

        return (new LandingCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    /**
     * @return LandingResource|string
     */
    public function detail(EntityDetailRequest $request)
    {
        $query = QueryBuilder::for(Landing::class)
            ->allowedFilters([
                AllowedFilter::exact(Landing::FIELD_ID)
            ])
            ->allowedIncludes([
                Landing::ENTITY_RELATIVE_FORMATS,
                Landing::ENTITY_RELATIVE_LEVELS,
                Landing::ENTITY_RELATIVE_DIRECTIONS,
                Landing::ENTITY_RELATIVE_CITIES,
                Landing::ENTITY_RELATIVE_ORGANIZATIONS
            ])
            ->firstOrFail();

        return (new LandingResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
