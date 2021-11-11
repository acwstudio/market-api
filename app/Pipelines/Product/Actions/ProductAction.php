<?php

declare(strict_types=1);

namespace App\Pipelines\Product\Actions;

use App\Services\ProductService;
use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipelineActionInterface;

final class ProductAction implements PipelineActionInterface
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function handle(DtoInterface $dto, Closure $next): DtoInterface
    {
        $dto = $this->productService->update($dto);

        return $next($dto);
    }
}
