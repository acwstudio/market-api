<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
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
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('published'),
                AllowedFilter::exact('name'),
                AllowedFilter::exact('slug'),
                AllowedFilter::callback('expiration_date', function (Builder $query, $value) {
                    $query->whereDate('expiration_date', '<=', date('Y-m-d H:i:s', strtotime($value)));
                }),
                AllowedFilter::exact('is_document'),
                AllowedFilter::exact('is_installment'),
                AllowedFilter::exact('is_employment'),
                AllowedFilter::exact('category_ids', 'category_id'),
                AllowedFilter::exact('organization_ids', 'organization_id'),
                AllowedFilter::exact('city_ids', 'organization.city_id'),
                AllowedFilter::exact('subject_ids', 'subjects.id'),
                AllowedFilter::exact('format_ids', 'formats.id'),
                AllowedFilter::exact('level_ids', 'levels.id'),
                AllowedFilter::exact('direction_ids', 'directions.id'),
                AllowedFilter::exact('person_ids', 'persons.id'),
            ])
            ->allowedIncludes(['organization', 'levels', 'directions', 'formats', 'organization.city', 'persons'])
            ->allowedSorts(['name', 'id', 'expiration_date', 'sort']);

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
    public function detail(EntityDetailRequest $request)
    {
        $query = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug')
            ])
            ->allowedIncludes(['organization', 'levels', 'directions', 'formats', 'organization.city', 'persons'])
            ->firstOrFail();

        return (new ProductResource($query))->additional([
            'success' => true,
            'log_request_id' => ''
        ]);
    }

}
