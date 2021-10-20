<?php

declare(strict_types=1);

namespace App\Repositories\Organization;

use App\Http\Requests\Organization\DetailRequest;
use App\Http\Requests\Organization\ListRequest;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationResource;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Level;
use App\Models\Organization;
use App\Models\Person;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class OrganizationRepository implements OrganizationRepositoryInterface
{
    private Organization $organization;

    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function getOrganizationsByFilters(ListRequest $request): OrganizationCollection
    {
        $query = QueryBuilder::for(Organization::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', Organization::FIELD_ID),
                AllowedFilter::exact(Organization::FIELD_PUBLISHED),
                AllowedFilter::exact(Organization::FIELD_NAME),
                AllowedFilter::exact(Organization::FIELD_SLUG),
                AllowedFilter::exact(Organization::FIELD_LAND),
                AllowedFilter::exact(Organization::FIELD_PARENT_ID),
                AllowedFilter::exact('city_ids', Organization::FIELD_CITY_ID),
                AllowedFilter::exact('direction_ids', implode('.', [Organization::ENTITY_RELATIVE_PRODUCTS, Product::ENTITY_RELATIVE_DIRECTIONS, Direction::FIELD_ID])),
                AllowedFilter::exact('level_ids', implode('.', [Organization::ENTITY_RELATIVE_PRODUCTS, Product::ENTITY_RELATIVE_LEVELS, Level::FIELD_ID])),
                AllowedFilter::exact('format_ids', implode('.', [Organization::ENTITY_RELATIVE_PRODUCTS, Product::ENTITY_RELATIVE_FORMATS, Format::FIELD_ID])),
                AllowedFilter::exact('product_ids', implode('.', [Organization::ENTITY_RELATIVE_PRODUCTS, Product::FIELD_ID])),
                AllowedFilter::exact('person_ids', implode('.', [Organization::ENTITY_RELATIVE_PERSONS, Person::FIELD_ID])),
            ])
            ->allowedIncludes([Organization::ENTITY_RELATIVE_CITY])
            ->allowedSorts([Organization::FIELD_ID, Organization::FIELD_NAME, Organization::FIELD_ADDRESS]);

        $pagination = $request->get('pagination') ?? ['page' => 1, 'page_size' => 10];

        return new OrganizationCollection($query->paginate(
            $pagination['page_size'],
            $columns = ['*'],
            $pageName = 'page',
            $pagination['page']
        ));
    }

    public function getOrganizationDetailByFilters(DetailRequest $request): OrganizationResource
    {
        $query = QueryBuilder::for(Organization::class)
            ->allowedFilters([
                AllowedFilter::exact(Organization::FIELD_ID),
                AllowedFilter::exact(Organization::FIELD_SLUG)
            ])
            ->allowedIncludes([Organization::ENTITY_RELATIVE_CITY, Organization::ENTITY_RELATIVE_PERSONS])
            ->firstOrFail();

        return new OrganizationResource($query);
    }
}
