<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\EntityDetailRequest;
use App\Http\Requests\Person\ListRequest;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;
use App\Repositories\Person\PersonRepositoryInterface;

final class PersonService
{
    private $personRepository;

    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function list(ListRequest $request): PersonCollection
    {
        return $this->personRepository->getPersonsByFilters($request);
    }

    public function detail(EntityDetailRequest $request): PersonResource
    {
        return $this->personRepository->getPersonDetailById($request);
    }
}
