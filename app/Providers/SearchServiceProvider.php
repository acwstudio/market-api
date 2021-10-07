<?php

namespace App\Providers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
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

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {

            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }
}
