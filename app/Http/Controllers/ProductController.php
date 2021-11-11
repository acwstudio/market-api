<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\DetailRequest;
use App\Http\Requests\Product\ListRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Pipelines\Product\ProductPipeline;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

final class ProductController extends Controller
{
    public ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(CreateRequest $request, ProductPipeline $pipeline): JsonResponse
    {
        $dto = $pipeline->create($request->dto());

       return response()->json($dto->toArray());
    }

    public function update(UpdateRequest $request, ProductPipeline $pipeline): JsonResponse
    {
        $dto = $pipeline->update($request->dto());

        return response()->json($dto->toArray());
    }

    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->productService->list($request);

        return response()->json([
            'success' => true,
            'data' => $collection,
            'count' => $collection->total(),
        ]);
    }

    public function detail(DetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->productService->detail($request)
        ]);
    }
}
