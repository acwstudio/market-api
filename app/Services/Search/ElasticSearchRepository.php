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

    public function search(string $model, string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($model, $query);

        return $this->buildCollection($model, $items);
    }

    private function searchOnElasticsearch(string $model, string $query = ''): array
    {
        $model = new $model;

        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['name^2', 'description'],
                    ],
                ],
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
