<?php

declare(strict_types=1);

namespace App\Pipelines\Product\Pipes;

use App\Services\ProductService;
use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipeInterface;

final class ProductPipe implements PipeInterface
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
