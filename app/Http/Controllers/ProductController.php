<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\Product\DetailRequest;
use App\Http\Requests\Product\ListRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;

final class ProductController extends Controller
{
    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function list(ListRequest $request): Response
    {
        $collection = $this->productService->list($request);

        return response([
            'data' => $collection,
            'success' => true,
            'count' => $collection->total(),
        ]);
    }

    public function detail(DetailRequest $request): ProductResource
    {
        return $this->productService
            ->detail($request)
            ->additional([
                'success' => true,
                'log_request_id' => '',
            ]);
    }

    public function store(CreateRequest $request)
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

    public function destroy($id)
    {
        return 'ok';
    }
}
