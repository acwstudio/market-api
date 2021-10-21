<?php

declare(strict_types=1);

namespace App\Repositories\Subject;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\SubjectCollection;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Request;

interface SubjectRepositoryInterface
{
    public function getSubjectsByFilters(Request $request): SubjectCollection;

    public function getSubjectDetailByFilters(EntityDetailRequest $request): SubjectResource;
}
