<?php

declare(strict_types=1);

namespace App\Repositories\EntitySection;

use App\Http\Requests\EntitySection\DetailRequest;
use App\Http\Requests\EntitySection\ListRequest;
use App\Http\Resources\Site\EntitySectionCollection;
use App\Http\Resources\Site\EntitySectionResource;

interface EntitySectionRepositoryInterface
{
    public function getEntitySectionList(ListRequest $request): EntitySectionCollection;

    public function getEntitySectionDetail(DetailRequest $request): EntitySectionResource;
}
