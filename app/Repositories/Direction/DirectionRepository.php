<?php

declare(strict_types=1);

namespace App\Repositories\Direction;

use App\Http\Requests\Direction\DetailRequest;
use App\Http\Requests\Direction\ListRequest;
use App\Http\Resources\DirectionCollection;
use App\Http\Resources\DirectionResource;
use App\Models\Direction;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class DirectionRepository  implements DirectionRepositoryInterface
{
    private Direction $direction;

    public function __construct(Direction $direction)
    {
        $this->direction = $direction;
    }

    public function getDirectionsByFilters(ListRequest $request): DirectionCollection
    {
        $query = QueryBuilder::for(Direction::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', Direction::FIELD_ID),
                AllowedFilter::exact(Direction::FIELD_PUBLISHED),
                AllowedFilter::exact(Direction::FIELD_NAME),
                AllowedFilter::exact(Direction::FIELD_SLUG),
                AllowedFilter::exact(Direction::FIELD_SHOW_MAIN),
                AllowedFilter::exact('product_ids', implode('.', [Direction::ENTITY_RELATIVE_PRODUCT, Product::FIELD_ID]))
            ])
            ->allowedSorts([Direction::FIELD_SORT, Direction::FIELD_NAME, Direction::FIELD_ID])
            ->get();

        return (new DirectionCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    public function getDirectionDetailByFilters(DetailRequest $request): DirectionResource
    {
        $query = QueryBuilder::for(Direction::class)
            ->allowedFilters([
                AllowedFilter::exact(Direction::FIELD_ID),
                AllowedFilter::exact(Direction::FIELD_SLUG),
            ])
            ->firstOrFail();

        return (new DirectionResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
