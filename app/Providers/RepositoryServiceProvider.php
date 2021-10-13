<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Product\CachedProductRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
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
    }
}
