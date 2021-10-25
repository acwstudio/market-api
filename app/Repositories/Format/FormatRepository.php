<?php

declare(strict_types=1);

namespace App\Repositories\Format;

use App\Http\Requests\Format\DetailRequest;
use App\Http\Requests\Format\ListRequest;
use App\Http\Resources\FormatCollection;
use App\Http\Resources\FormatResource;
use App\Models\Format;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class FormatRepository implements FormatRepositoryInterface
{

    public function getFormatsByFilters(ListRequest $request): FormatCollection
    {
        $query = QueryBuilder::for(Format::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', Format::FIELD_ID),
                AllowedFilter::exact(Format::FIELD_PUBLISHED),
                AllowedFilter::exact(Format::FIELD_NAME),
                AllowedFilter::exact(Format::FIELD_SLUG),
                AllowedFilter::exact('product_ids', implode('.', [Format::ENTITY_RELATIVE_PRODUCT, Product::FIELD_ID]))
            ])
            ->allowedSorts([Format::FIELD_NAME, Format::FIELD_ID])
            ->get();

        return (new FormatCollection($query));
    }

    public function getFormatDetailByFilters(DetailRequest $request): FormatResource
    {
        $query = QueryBuilder::for(Format::class)
            ->allowedFilters([
                AllowedFilter::exact(Format::FIELD_ID),
                AllowedFilter::exact(Format::FIELD_SLUG),
            ])
            ->firstOrFail();

        return (new FormatResource($query));
    }
}
