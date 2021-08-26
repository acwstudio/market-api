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
use App\Models\Organization;
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
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('published'),
                AllowedFilter::exact('name'),
                AllowedFilter::exact('slug'),
                AllowedFilter::exact('land'),
                AllowedFilter::exact('parent_id'),
                AllowedFilter::exact('product_ids', 'products.id'),
                AllowedFilter::exact('person_ids', 'persons.id'),
            ])
            ->allowedSorts(['id', 'name', 'address'])
            ->get();

        return (new OrganizationCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    public function detail(EntityDetailRequest $request)
    {
        $query = QueryBuilder::for(Organization::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug')
            ])
            ->firstOrFail();

        return (new OrganizationResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
