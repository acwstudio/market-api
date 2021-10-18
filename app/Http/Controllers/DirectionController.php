<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Direction\DetailRequest;
use App\Http\Requests\Direction\ListRequest;
use App\Http\Resources\DirectionResource;
use App\Services\DirectionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

final class DirectionController extends Controller
{
    /**
     * @var DirectionService
     */
    public $directionService;

    public function __construct(DirectionService $directionService)
    {
        $this->directionService = $directionService;
    }

    /**
     * @param ListRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function list(ListRequest $request)
    {
        $collection = $this->directionService->list($request);

        return response([
            'data' => $collection,
            'success' =>true,
            'count' => $collection->count(),
        ]);
    }

    /**
     * @return DirectionResource|string
     */
    public function detail(DetailRequest $request)
    {
        return $this->directionService
            ->detail($request)
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }

}
