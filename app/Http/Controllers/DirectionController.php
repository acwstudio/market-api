<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\DirectionCollection;
use App\Http\Resources\DirectionResource;
use App\Models\Direction;
use App\Models\Product;
use App\Repositories\DirectionRepository;
use Arr;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DirectionController extends Controller
{
    /**
     * @var DirectionRepository
     */
    public $directionRepository;

    public function __construct(DirectionRepository $directionRepository)
    {
        $this->directionRepository = $directionRepository;
    }

    public function list(Request $request)
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

    /**
     * @return DirectionResource|string
     */
    public function detail(EntityDetailRequest $request)
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
