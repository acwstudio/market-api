<?php

declare(strict_types=1);

namespace App\Repositories\Quiz;

use App\Http\Requests\Quiz\DetailRequest;
use App\Http\Requests\Quiz\ListRequest;
use App\Http\Resources\Site\QuizResource;
use App\Http\Resources\Site\QuizCollection;
use App\Repositories\CachedRepository;
use Illuminate\Support\Facades\Cache;

final class CachedQuizRepository extends CachedRepository implements QuizRepositoryInterface
{
    private $statsRepository;

    public function __construct(QuizRepositoryInterface $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getQuizzesByFilters(ListRequest $request): QuizCollection
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function() use ($request) {
                return $this->statsRepository->getQuizzesByFilters($request);
            });
    }

    public function getQuizDetailByFilters(DetailRequest $request): QuizResource
    {
        return Cache::remember($this->getCacheKey($request->all()), $this->getTtl(),
            function() use ($request) {
                return $this->statsRepository->getQuizDetailByFilters($request);
            });
    }
}
