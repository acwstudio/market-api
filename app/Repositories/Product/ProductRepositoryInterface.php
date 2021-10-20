<?php

declare(strict_types=1);

namespace App\Repositories\Product;

use App\Http\Requests\Product\DetailRequest;
use App\Http\Requests\Product\ListRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;

interface ProductRepositoryInterface
{
    public function getProductsByFilters(ListRequest $request): ProductCollection;

    public function getProductDetailByFilters(DetailRequest $request): ProductResource;
}