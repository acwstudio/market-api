<?php

declare(strict_types=1);

namespace App\Providers;

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
    }
}
