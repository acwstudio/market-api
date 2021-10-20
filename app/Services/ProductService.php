<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Product\DetailRequest;
use App\Http\Requests\Product\ListRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Resources\ProductCollection;

final class ProductService
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function list(ListRequest $request): ProductCollection
    {
        return $this->productRepository->getProductsByFilters($request);
    }

    public function detail(DetailRequest $request): ProductResource
    {
        return $this->productRepository->getProductDetailByFilters($request);
    }
}
