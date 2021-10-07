<?php

namespace App\Services\Search;

use Elasticsearch\Client;

/**
 * This trait includes model methods for searching
 */
trait Searchable
{
    public static function bootSearchable()
    {
        // This makes it easy to toggle the search feature flag
        // on and off. This is going to prove useful later on
        // when deploy the new search engine to a live app.
        if (config('services.search.enabled')) {
            static::observe(ElasticsearchObserver::class);
        }
    }

    /**
     * @return string
     */
    public function getSearchIndex(): string
    {
        return $this->getTable();
    }

    /**
     * @return mixed|string
     */
    public function getSearchType(): mixed
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }

        return $this->getTable();
    }

    /**
     * @return array
     */
    public function toSearchArray(): array
    {
        // By having a custom method that transforms the model
        // to a searchable array allows us to customize the
        // data that's going to be searchable per model.
        return $this->toArray();
    }
}
