<?php

declare(strict_types=1);

namespace App\Repositories\Subject;

use App\Http\Requests\Subject\DetailRequest;
use App\Http\Requests\Subject\ListRequest;
use App\Http\Resources\SubjectCollection;
use App\Http\Resources\SubjectResource;

interface SubjectRepositoryInterface
{
    public function getSubjectsByFilters(ListRequest $request): SubjectCollection;

    public function getSubjectDetailByFilters(DetailRequest $request): SubjectResource;
}
