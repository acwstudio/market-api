<?php

namespace App\Services\Search;

use App\Models\Product;
use App\Services\Search\SearchRepository;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

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

    public function search(string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new Product;

        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['name', 'description'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        return $items;
    }

    private function buildCollection(array $items): Collection
    {
//        dd($items['hits']['hits'], '_id');
        $ids = \Arr::pluck($items['hits']['hits'], '_id');
        dd($ids);
        return Product::findMany($ids)
            ->sortBy(function ($product) use ($ids) {
                return array_search($product->getKey(), $ids);
            });
    }
}
