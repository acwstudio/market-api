<?php

declare(strict_types=1);

namespace App\Repositories\Person;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\Person\ListRequest;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;

interface PersonRepositoryInterface
{
    public function getPersonsByFilters(ListRequest $request): PersonCollection;

    public function getPersonDetailById(EntityDetailRequest $request): PersonResource;
}
