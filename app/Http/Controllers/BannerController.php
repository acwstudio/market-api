<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\BannerCollection;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Services\BannerService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BannerController extends Controller
{
    public $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $collection = $this->bannerService->list($request);

        return response()->json([
            'success' => true,
            'count'   => $collection->count(),
            'data'    => $collection,
        ]);
    }

    /**
     * @return BannerResource|string
     */
    public function detail(EntityDetailRequest $request)
    {
        return response()->json([
            'success' => true,
            'data' => $this->bannerService->detail($request),
            'log_request_id' => ''
        ]);
    }

}
