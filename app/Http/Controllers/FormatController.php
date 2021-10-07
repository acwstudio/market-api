<?php


namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\FormatCollection;
use App\Http\Resources\FormatResource;
use App\Models\Format;
use App\Models\Product;
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
                AllowedFilter::exact('ids', Format::FIELD_ID),
                AllowedFilter::exact(Format::FIELD_PUBLISHED),
                AllowedFilter::exact(Format::FIELD_NAME),
                AllowedFilter::exact(Format::FIELD_SLUG),
                AllowedFilter::exact('product_ids', implode('.', [Format::ENTITY_RELATIVE_PRODUCT, Product::FIELD_ID]))
            ])
            ->allowedSorts([Format::FIELD_NAME, Format::FIELD_ID])
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
                AllowedFilter::exact(Format::FIELD_ID),
                AllowedFilter::exact(Format::FIELD_SLUG),
            ])
            ->firstOrFail();

        return (new FormatResource($query))
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
