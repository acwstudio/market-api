<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\Banner\DetailRequest;
use App\Http\Requests\Banner\ListRequest;
use App\Http\Resources\BannerResource;
use App\Repositories\Banner\BannerRepositoryInterface;
use App\Http\Resources\BannerCollection;
use Illuminate\Http\Request;

final class BannerService
{
    private $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function list(ListRequest $request): BannerCollection
    {
        return $this->bannerRepository->getBannersByFilters($request);
    }

    public function detail(DetailRequest $request): BannerResource
    {
        return $this->bannerRepository->getBannerDetailByFilters($request);
    }

}
