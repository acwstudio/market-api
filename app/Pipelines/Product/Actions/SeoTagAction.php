<?php

declare(strict_types=1);

namespace App\Pipelines\Product\Actions;

use App\Dto\SeoTag\SeoTagDto;
use App\Models\Product;
use App\Services\SeoTagService;
use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipelineActionInterface;

final class SeoTagAction implements PipelineActionInterface
{
    private SeoTagService $seoTagService;

    public function __construct(SeoTagService $seoTagService)
    {
        $this->seoTagService = $seoTagService;
    }

    public function handle(DtoInterface $dto, Closure $next): DtoInterface
    {
        if (!is_null($dto->getId())) {
            $seoTagDto = SeoTagDto::fromArray([
                null,
                Product::class,
                $dto->getId(),
                $dto->getSeoH1(),
                $dto->getSeoTitle(),
                $dto->getSeoKeywords(),
                $dto->getSeoDescription()
            ]);

            $this->seoTagService->create($seoTagDto);
        }

        return $next($dto);
    }
}
