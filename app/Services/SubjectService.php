<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Subject\DetailRequest;
use App\Http\Requests\Subject\ListRequest;
use App\Http\Resources\SubjectResource;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Http\Resources\SubjectCollection;

final class SubjectService
{
    private $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function list(ListRequest $request): SubjectCollection
    {
        return $this->subjectRepository->getSubjectsByFilters($request);
    }

    public function detail(DetailRequest $request): SubjectResource
    {
        return $this->subjectRepository->getSubjectDetailByFilters($request);
    }

}
