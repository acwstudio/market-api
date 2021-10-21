<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\SubjectResource;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Http\Resources\SubjectCollection;
use Illuminate\Http\Request;

final class SubjectService
{
    private $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function list(Request $request): SubjectCollection
    {
        return $this->subjectRepository->getSubjectsByFilters($request);
    }

    public function detail(EntityDetailRequest $request): SubjectResource
    {
        return $this->subjectRepository->getSubjectDetailByFilters($request);
    }

}
