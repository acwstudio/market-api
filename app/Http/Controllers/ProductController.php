<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Level;
use App\Models\Organization;
use App\Models\Person;
use App\Models\Product;
use App\Models\Subject;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    public $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function list(Request $request)
    {
        $query = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', Product::FIELD_ID),
                AllowedFilter::exact(Product::FIELD_PUBLISHED),
                AllowedFilter::exact(Product::FIELD_NAME),
                AllowedFilter::exact(Product::FIELD_SLUG),
                AllowedFilter::callback(Product::FIELD_EXPIRATION_DATE, function (Builder $query, $value) {
                    $query->whereDate(Product::FIELD_EXPIRATION_DATE, '<=', date('Y-m-d H:i:s', strtotime($value)));
                }),
                AllowedFilter::exact(Product::FIELD_IS_DOCUMENT),
                AllowedFilter::exact(Product::FIELD_IS_INSTALLMENT),
                AllowedFilter::exact(Product::FIELD_IS_EMPLOYMENT),
                AllowedFilter::exact('category_ids', Product::FIELD_CATEGORY_ID),
                AllowedFilter::exact('organization_ids', Product::FIELD_ORGANIZATION_ID),
                AllowedFilter::exact('city_ids', implode('.', [Product::ENTITY_RELATIVE_ORGANIZATION, Organization::FIELD_CITY_ID])),
                AllowedFilter::exact('subject_ids', implode('.', [Product::ENTITY_RELATIVE_SUBJECTS, Subject::FIELD_ID])),
                AllowedFilter::exact('format_ids', implode('.', [Product::ENTITY_RELATIVE_FORMATS, Format::FIELD_ID])),
                AllowedFilter::exact('level_ids', implode('.', [Product::ENTITY_RELATIVE_LEVELS, Level::FIELD_ID])),
                AllowedFilter::exact('direction_ids', implode('.', [Product::ENTITY_RELATIVE_DIRECTIONS, Direction::FIELD_ID])),
                AllowedFilter::exact('person_ids', implode('.', [Product::ENTITY_RELATIVE_PERSONS, Person::FIELD_ID])),
            ])
            ->allowedIncludes([Product::ENTITY_RELATIVE_ORGANIZATION, Product::ENTITY_RELATIVE_LEVELS, Product::ENTITY_RELATIVE_DIRECTIONS, Product::ENTITY_RELATIVE_FORMATS, implode('.', [Product::ENTITY_RELATIVE_ORGANIZATION, Organization::ENTITY_RELATIVE_CITY]), Product::ENTITY_RELATIVE_PERSONS])
            ->allowedSorts([Product::FIELD_NAME, Product::FIELD_ID, Product::FIELD_EXPIRATION_DATE, Product::FIELD_SORT]);

        $pagination = $request->json()->all()['pagination'] ?? ['page' => 1, 'page_size' => 10];
        $count = $query->count();

        $collection = new ProductCollection($query->paginate(
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

    /**
     * @return ProductResource|string
     */
    public function detail(Request $request)
    {
        $query = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact(Product::FIELD_ID),
                AllowedFilter::exact(Product::FIELD_SLUG)
            ])
            ->allowedIncludes([Product::ENTITY_RELATIVE_ORGANIZATION, Product::ENTITY_RELATIVE_LEVELS, Product::ENTITY_RELATIVE_DIRECTIONS, Product::ENTITY_RELATIVE_FORMATS, implode('.', [Product::ENTITY_RELATIVE_ORGANIZATION, Organization::ENTITY_RELATIVE_CITY]), Product::ENTITY_RELATIVE_PERSONS])
            ->firstOrFail();

        return (new ProductResource($query))->additional([
            'success' => true,
            'log_request_id' => ''
        ]);
    }

}
