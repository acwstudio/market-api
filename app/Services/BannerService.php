<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\EntityDetailRequest;
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

    public function list(Request $request): BannerCollection
    {
        return $this->bannerRepository->getBannersByFilters($request);
    }

    public function detail(EntityDetailRequest $request): BannerResource
    {
        return $this->bannerRepository->getBannerDetailByFilters($request);
    }

}
