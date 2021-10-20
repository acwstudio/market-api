<?php

declare(strict_types=1);

namespace App\Repositories\Person;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\Person\ListRequest;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;
use Illuminate\Support\Facades\Cache;
use App\Repositories\CachedRepository;

final class CachedPersonRepository extends CachedRepository implements PersonRepositoryInterface
{
    private $personRepository;

    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function getPersonsByFilters(ListRequest $request): PersonCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->personRepository->getPersonsByFilters($request);
            });
    }

    public function getPersonDetailById(EntityDetailRequest $request): PersonResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->personRepository->getPersonDetailById($request);
            });
    }
}
