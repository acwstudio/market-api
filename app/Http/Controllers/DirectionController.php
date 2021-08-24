<?php

namespace App\Http\Controllers;

use App\Http\Resources\DirectionDetailResource;
use App\Http\Resources\DirectionListCollection;
use App\Models\Direction;
use App\Repositories\DirectionRepository;
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

        return (new DirectionListCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    /**
     * @return DirectionDetailResource|string
     */
    public function detail()
    {
        $query = QueryBuilder::for(Direction::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug'),
            ])
            ->firstOrFail();

        return (new DirectionDetailResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);

    }

}
