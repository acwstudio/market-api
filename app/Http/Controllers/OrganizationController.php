<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Organization\DetailRequest;
use App\Http\Requests\Organization\ListRequest;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;
use Illuminate\Http\Response;

final class OrganizationController extends Controller
{
    private $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function list(ListRequest $request): Response
    {
        $collection = $this->organizationService->list($request);

        return response([
            'data' => $collection,
            'success' =>true,
            'count' => $collection->total(),
        ]);
    }

    public function detail(DetailRequest $request): OrganizationResource
    {
        return $this->organizationService
            ->detail($request)
            ->additional([
                'success' => true,
                'log_request_id' => ''
            ]);
    }
}
