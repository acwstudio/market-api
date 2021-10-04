<?php

namespace App\Http\Controllers;

use App\Core\Error\ErrorManager;
use App\Core\Input\Fields\Organization\OrganizationGetList;
use App\Core\Input\Fields\Organization\OrganizationGetDetail;
use App\Core\FieldSet;
use App\Core\Response\ResponseTrait;
use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\OrganizationListCollection;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Level;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Person;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class OrganizationController extends Controller
{
    /**
     * @var OrganizationRepository
     */
    public $organizationRepository;

    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function list(Request $request){
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

        $pagination = $request->json()->all()['pagination'] ?? ['page' => 1, 'page_size' => 10];
        $count = $query->count();

        $collection = new OrganizationCollection($query->paginate(
            $pagination['page_size'],
            $columns = ['*'],
            $pageName = 'page',
            $pagination['page']
        ));

        return response([
            'data' => $collection,
            'success' =>true,
            'count' => $count
        ]);
    }

    public function detail(Request $request)
    {
        $query = QueryBuilder::for(Organization::class)
            ->allowedFilters([
                AllowedFilter::exact(Organization::FIELD_ID),
                AllowedFilter::exact(Organization::FIELD_SLUG)
            ])
            ->allowedIncludes([Organization::ENTITY_RELATIVE_CITY, Organization::ENTITY_RELATIVE_PERSONS])
            ->firstOrFail();

        return (new OrganizationResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
