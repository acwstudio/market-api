<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\City\DetailRequest;
use App\Http\Requests\City\ListRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CityController extends Controller
{
    private CityService $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function list(ListRequest $request): Application|ResponseFactory|Response
    {
        $collection = $this->cityService->list($request);

        return response([
            'data' => $collection,
            'success' =>true,
            'count' => $collection->count(),
        ]);
    }

    /**
     * @return CityResource|string
     */
    public function detail(DetailRequest $request)
    {
        return $this->cityService
            ->detail($request)
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);

    }
}
