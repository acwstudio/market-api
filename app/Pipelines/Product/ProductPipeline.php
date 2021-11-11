<?php

declare(strict_types=1);

namespace App\Pipelines\Product;

use App\Models\Activity;
use App\Models\Product;
use App\Services\ProductService;
use Exception;
use Throwable;
use App\Dto\Product\ProductDto;
use App\Pipelines\AbstractPipeline;
use App\Pipelines\Product\Actions\SeoTagAction;
use App\Pipelines\Product\Actions\ProductAction;
use App\Pipelines\Product\Actions\EntitySectionAction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class ProductPipeline extends AbstractPipeline
{
    public function create(ProductDto $dto): ProductDto
    {
        try {
            DB::beginTransaction();

            $dto = $this->pipeline
                ->send($dto)
                ->through([
                    SeoTagAction::class,
                    ProductAction::class,
                    EntitySectionAction::class,
                ])
                ->then(function (ProductDto $newDto) {
                    return $newDto;
                });

            DB::commit();

            $this->activityService->create(
                Product::class,
                Activity::ACTION_CREATE,
                $dto->getId()
            );

            return $dto;
        } catch (Exception | Throwable $e) {
            DB::rollBack();
            Log::error($e);
        }

        throw new Exception('Ошибка обработки сценария');
    }

    public function update(ProductDto $dto): ProductDto
    {
        try {
            DB::beginTransaction();

            $dto = $this->pipeline
                ->send($dto)
                ->through([
                    SeoTagAction::class,
                    ProductAction::class,
                ])
                ->then(function (ProductDto $newDto) {
                    return $newDto;
                });

            DB::commit();

            $this->activityService->create(
                Product::class,
                Activity::ACTION_UPDATE,
                $dto->getId()
            );

            return $dto;
        } catch (Exception | Throwable $e) {
            DB::rollBack();
            Log::error($e);
        }

        throw new Exception('Ошибка обработки сценария');
    }

    public function delete(int $id): void
    {
        try {
            DB::beginTransaction();

            $productService = app(ProductService::class);
            $productService->delete($id);

            DB::commit();

            $this->activityService->create(
                Product::class,
                Activity::ACTION_DELETE,
                $id
            );
        } catch (Exception | Throwable $e) {
            DB::rollBack();
            Log::error($e);
        }
    }
}
