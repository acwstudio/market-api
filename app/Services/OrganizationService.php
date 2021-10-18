<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Organization\DetailRequest;
use App\Http\Requests\Organization\ListRequest;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationResource;
use App\Repositories\Organization\OrganizationRepositoryInterface;

final class OrganizationService
{
    private $organizationRepository;

    public function __construct(OrganizationRepositoryInterface $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function list(ListRequest $request): OrganizationCollection
    {
        return $this->organizationRepository->getOrganizationsByFilters($request);
    }

    public function detail(DetailRequest $request): OrganizationResource
    {
        return $this->organizationRepository->getOrganizationDetailByFilters($request);
    }
}
