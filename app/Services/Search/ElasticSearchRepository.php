<?php

namespace App\Services\Search;

use App\Models\Product;
use App\Services\Search\SearchRepository;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ElasticSearchRepository implements SearchRepository
{
    /**
     * @var Client
     */
    public Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $model, string $search = ''): Collection
    {
        $items = $this->searchOnElasticsearch($model, $search);

        return $this->buildCollection($model, $items);
    }

    private function searchOnElasticsearch(string $model, string $query = ''): array
    {
        /** @var Model|Product $modelObj */
        $modelObj = new $model;
        foreach (array_keys(\Arr::dot(config('api.search'))) as $item) {
            if (str_contains($item, 'query')){
                config(['api.search.' . $item => $query]);
            }
        }
        $items = $this->elasticsearch->search([
            'index' => $modelObj->getSearchIndex(),
            'type' => $modelObj->getSearchType(),
            'body' => [
                'query' => config('api.search')
            ],
        ]);

        return $items;
    }

    private function buildCollection(string $model, array $items): Collection
    {
        $model = new $model;

        $ids = \Arr::pluck($items['hits']['hits'], '_id');
        return $model->findMany($ids)
            ->sortBy(function ($model) use ($ids) {
                return array_search($model->getKey(), $ids);
            });
    }
}
