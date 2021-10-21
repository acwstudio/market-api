<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\Person\ListRequest;
use App\Services\PersonService;
use Illuminate\Http\JsonResponse;

final class PersonController extends Controller
{
    private $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function list(ListRequest $request): JsonResponse
    {
        $collection = $this->personService->list($request);

        return response()->json([
            'success' => true,
            'data' => $collection,
            'count' => $collection->count(),
        ]);
    }

    public function detail(EntityDetailRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->personService->detail($request),
        ]);
    }
}
