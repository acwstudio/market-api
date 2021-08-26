<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\DirectionCollection;
use App\Http\Resources\DirectionResource;
use App\Models\Direction;
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
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('published'),
                AllowedFilter::exact('name'),
                AllowedFilter::exact('slug'),
                AllowedFilter::exact('show_main'),
                AllowedFilter::exact('product_ids', 'products.id')
            ])
            ->allowedSorts(['sort', 'name', 'id'])
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
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug'),
            ])
            ->firstOrFail();

        return (new DirectionResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);

    }

}
