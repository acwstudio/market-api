<?php

declare(strict_types=1);

namespace App\Repositories\Product;

use App\Dto\Product\ProductDto;
use App\Http\Requests\Product\DetailRequest;
use App\Http\Requests\Product\ListRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\CachedRepository;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ProductCollection;

final class CachedProductRepository extends CachedRepository implements ProductRepositoryInterface
{
    private ProductRepositoryInterface $statsRepository;

    public function __construct(ProductRepositoryInterface $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function updateOrCreate(ProductDto $dto): ProductDto
    {
        return $this->statsRepository->updateOrCreate($dto);
    }

    public function getProductsByFilters(ListRequest $request): ProductCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getProductsByFilters($request);
            });
    }

    public function getProductDetailByFilters(DetailRequest $request): ProductResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getProductDetailByFilters($request);
            });
    }
}
