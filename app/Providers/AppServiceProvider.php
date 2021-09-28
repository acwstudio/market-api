<?php

namespace App\Providers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Services\Search\SearchRepository::class, function ($app) {
            // This is useful in case we want to turn-off our
            // search cluster or when deploying the search
            // to a live, running application at first.
            if (! config('services.search.enabled')) {
                return new \App\Services\Search\EloquentSearchRepository();
            }

            return new \App\Services\Search\ElasticSearchRepository(
                $app->make(Client::class)
            );
        });

        $this->bindSearchClient();

//        $this->app->bind(\App\Services\Search\SearchRepository::class, \App\Services\Search\EloquentSearchRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $scheme = parse_url(config('app.url'), PHP_URL_SCHEME);
//        URL::forceScheme($scheme);
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
//            dd($app['config']);
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }
}
