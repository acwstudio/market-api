<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Format\DetailRequest;
use App\Http\Requests\Format\ListRequest;
use App\Http\Resources\FormatCollection;
use App\Http\Resources\FormatResource;
use App\Repositories\Format\FormatRepositoryInterface;

class FormatService
{
    private $formatRepository;

    public function __construct(FormatRepositoryInterface $formatRepository)
    {
        $this->formatRepository = $formatRepository;
    }

    public function list(ListRequest $request): FormatCollection
    {
        return $this->formatRepository->getFormatsByFilters($request);
    }

    public function detail(DetailRequest $request): FormatResource
    {
        return $this->formatRepository->getFormatDetailByFilters($request);
    }
}
