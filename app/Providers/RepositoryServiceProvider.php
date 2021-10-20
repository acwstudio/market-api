<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\City\CachedCityRepository;
use App\Repositories\City\CityRepository;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Landing\CachedLandingRepository;
use App\Repositories\Landing\LandingRepository;
use App\Repositories\Landing\LandingRepositoryInterface;
use App\Repositories\Product\CachedProductRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Organization\CachedOrganizationRepository;
use App\Repositories\Organization\OrganizationRepository;
use App\Repositories\Organization\OrganizationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            CachedProductRepository::class
        );

        $this->app->when(CachedProductRepository::class)
            ->needs(ProductRepositoryInterface::class)
            ->give(ProductRepository::class);

        $this->app->bind(
            OrganizationRepositoryInterface::class,
            CachedOrganizationRepository::class
        );

        $this->app->when(CachedOrganizationRepository::class)
            ->needs(OrganizationRepositoryInterface::class)
            ->give(OrganizationRepository::class);

        $this->app->bind(
            CityRepositoryInterface::class,
            CachedCityRepository::class
        );

        $this->app->when(CachedCityRepository::class)
            ->needs(CityRepositoryInterface::class)
            ->give(CityRepository::class);
        
        $this->app->bind(
            LandingRepositoryInterface::class,
            CachedLandingRepository::class
        );
        
        $this->app->when(CachedLandingRepository::class)
            ->needs(LandingRepositoryInterface::class)
            ->give(LandingRepository::class);
    }
}
