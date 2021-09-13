<?php


namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\FormatCollection;
use App\Http\Resources\FormatResource;
use App\Models\Format;
use App\Repositories\FormatRepository;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FormatController extends Controller
{
    /**
     * @var FormatRepository
     */
    public $formatRepository;

    public function __construct(FormatRepository $formatRepository)
    {
        $this->formatRepository = $formatRepository;
    }

    public function list(Request $request)
    {
        $query = QueryBuilder::for(Format::class)
            ->allowedFilters([
                AllowedFilter::exact('ids', 'id'),
                AllowedFilter::exact('published'),
                AllowedFilter::exact('name'),
                AllowedFilter::exact('slug'),
                AllowedFilter::exact('product_ids', 'products.id')
            ])
            ->allowedSorts(['name', 'id'])
            ->get();

        return (new FormatCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }

    /**
     * @return FormatResource
     */
    public function detail(EntityDetailRequest $request)
    {
        $query = QueryBuilder::for(Format::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug'),
            ])
            ->firstOrFail();

        return (new FormatResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
