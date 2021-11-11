<?php

declare(strict_types=1);

namespace App\Pipelines\Product\Actions;

use App\Dto\DtoInterface;
use App\Models\Product;
use App\Pipelines\PipelineActionInterface;
use App\Services\EntitySectionService;
use Closure;

final class EntitySectionAction implements PipelineActionInterface
{
    private EntitySectionService $entitySectionService;

    public function __construct(EntitySectionService $entitySectionService)
    {
        $this->entitySectionService = $entitySectionService;
    }

    public function handle(DtoInterface $dto, Closure $next): DtoInterface
    {
        if ($idOriginProduct = $dto->getIdOriginProduct()) {
            $this->entitySectionService->copyByOriginProduct(Product::class, $idOriginProduct, $dto->getId());
        }

        return $next($dto);
    }
}
