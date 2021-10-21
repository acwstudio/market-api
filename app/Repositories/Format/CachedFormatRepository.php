<?php

declare(strict_types=1);

namespace App\Repositories\Format;

use App\Http\Requests\Format\DetailRequest;
use App\Http\Requests\Format\ListRequest;
use App\Http\Resources\FormatCollection;
use App\Http\Resources\FormatResource;
use App\Repositories\CachedRepository;
use Illuminate\Support\Facades\Cache;

final class CachedFormatRepository extends CachedRepository implements FormatRepositoryInterface
{
    private $formatRepository;

    public function __construct(FormatRepositoryInterface $formatRepository)
    {
        $this->formatRepository = $formatRepository;
    }

    public function getFormatsByFilters(ListRequest $request): FormatCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->formatRepository->getFormatsByFilters($request);
            });
    }

    public function getFormatDetailByFilters(DetailRequest $request): FormatResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function () use ($request) {
                return $this->formatRepository->getFormatDetailByFilters($request);
            });
    }
}
