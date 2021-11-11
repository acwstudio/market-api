<?php

declare(strict_types=1);

namespace App\Pipelines\Product\Actions;

use App\Dto\DtoInterface;
use App\Models\Activity;
use App\Models\Product;
use App\Pipelines\PipelineActionInterface;
use App\Services\ActivityService;
use Closure;

final class InsertActivityAction implements PipelineActionInterface
{
    private ActivityService $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function handle(DtoInterface $dto, Closure $next): DtoInterface
    {
        $this->activityService->create(
            Product::class,
            Activity::ACTION_CREATE,
            $dto->getId()
        );

        return $next($dto);
    }
}
