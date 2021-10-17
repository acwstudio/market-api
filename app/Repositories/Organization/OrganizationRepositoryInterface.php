<?php

declare(strict_types=1);

namespace App\Repositories\Organization;

use App\Http\Requests\Organization\DetailRequest;
use App\Http\Requests\Organization\ListRequest;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationResource;

interface OrganizationRepositoryInterface
{
    public function getOrganizationsByFilters(ListRequest $request): OrganizationCollection;

    public function getOrganizationDetailByFilters(DetailRequest $request): OrganizationResource;
}
