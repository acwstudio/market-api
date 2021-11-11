<?php

declare(strict_types=1);

namespace App\Pipelines\Product;

use Exception;
use Throwable;
use App\Dto\Product\ProductDto;
use App\Pipelines\AbstractPipeline;
use App\Pipelines\Product\Actions\SeoTagAction;
use App\Pipelines\Product\Actions\ProductAction;
use App\Pipelines\Product\Actions\EntitySectionAction;
use App\Pipelines\Product\Actions\InsertActivityAction;
use App\Pipelines\Product\Actions\UpdateActivityAction;
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
                    InsertActivityAction::class,
                ])
                ->then(function (ProductDto $newDto) {
                    return $newDto;
                });

            DB::commit();

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
                    UpdateActivityAction::class,
                ])
                ->then(function (ProductDto $newDto) {
                    return $newDto;
                });

            DB::commit();

            return $dto;
        } catch (Exception | Throwable $e) {
            DB::rollBack();
            Log::error($e);
        }

        throw new Exception('Ошибка обработки сценария');
    }
}
