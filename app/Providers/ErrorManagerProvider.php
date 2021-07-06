<?php

namespace App\Providers;

use App\Core\Error\ErrorManager;
use Illuminate\Support\ServiceProvider;

class ErrorManagerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ErrorManager::class, function ($app) {
            return new ErrorManager(config('errors'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
