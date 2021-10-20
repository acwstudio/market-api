<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Product\DetailRequest;
use App\Http\Requests\Product\ListRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

final class ProductController extends Controller
{
    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->productService->list($request);

        return response()->json([
            'success' => true,
            'data'    => $collection,
            'count'   => $collection->total(),
        ]);
    }

    public function detail(DetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $this->productService->detail($request)
        ]);
    }
}
