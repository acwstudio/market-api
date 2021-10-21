<?php

declare(strict_types=1);

namespace App\Repositories\Subject;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Resources\SubjectResource;
use App\Repositories\CachedRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\SubjectCollection;

final class CachedSubjectRepository extends CachedRepository implements SubjectRepositoryInterface
{
    private $statsRepository;

    public function __construct(SubjectRepositoryInterface $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getSubjectsByFilters(Request $request): SubjectCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getSubjectsByFilters($request);
            });
    }

    public function getSubjectDetailByFilters(EntityDetailRequest $request): SubjectResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->statsRepository->getSubjectDetailByFilters($request);
            });
    }

}
