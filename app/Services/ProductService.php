<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Product\ProductDto;
use App\Http\Requests\Product\DetailRequest;
use App\Http\Requests\Product\ListRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Resources\ProductCollection;

final class ProductService
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(ProductDto $dto): ProductDto
    {
        $dto = $this->productRepository->updateOrCreate($dto);
        $this->productRepository->attachRelations($dto);

        return $dto;
    }

    public function update(ProductDto $dto): ProductDto
    {
        $dto = $this->productRepository->updateOrCreate($dto);
        $this->productRepository->attachRelations($dto);

        return $dto;
    }

    public function list(ListRequest $request): ProductCollection
    {
        return $this->productRepository->getProductsByFilters($request);
    }

    public function detail(DetailRequest $request): ProductResource
    {
        return $this->productRepository->getProductDetailByFilters($request);
    }

    public function delete(int $id): void
    {
        $this->productRepository->delete($id);
    }
}
