<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\ProductCreateRequest;
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
                AllowedFilter::exact('organization_ids', 'organization_id'),
                AllowedFilter::exact('subject_ids', 'subjects.id'),
                AllowedFilter::exact('format_ids', 'formats.id'),
                AllowedFilter::exact('level_ids', 'levels.id'),
                AllowedFilter::exact('direction_ids', 'directions.id'),
                AllowedFilter::exact('person_ids', 'persons.id'),
            ])
            ->allowedIncludes(['organization', 'levels', 'directions', 'formats'])
            ->allowedSorts(['name', 'id', 'expiration_date']);

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
            ->firstOrFail();

        return (new ProductResource($query))->additional([
            'success' => true,
            'log_request_id' => ''
        ]);
    }

    public function store(ProductCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');

        $product = Product::create([
            'is_moderated'    => $dataAttributes['is_moderated'],
            'name'            => $dataAttributes['name'],
            'published'       => $dataAttributes['published'],
            'slug'            => $dataAttributes['slug'],
            'sort'            => $dataAttributes['sort'],
            'is_employment'   => $dataAttributes['is_employment'],
            'is_installment'  => $dataAttributes['is_installment'],
            'is_document'     => $dataAttributes['is_document'],
            'color'           => $dataAttributes['color'],
            'organization_id' => $dataAttributes['organization_id'],
            'category_id'     => $dataAttributes['category_id'],
            'user_id'         => $dataAttributes['user_id'],
        ]);

        return (new ProductResource($product))
            ->response();
//            ->header('Location', route('admin.authors.show', [
//                'author' => $product
//            ]));
    }

}
