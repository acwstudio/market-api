<?php

namespace App\Services\Search;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EloquentSearchRepository implements SearchRepository
{
    public function search(string $model, string $term): Collection
    {
        $model = new $model;

        return $model->query()
            ->where(fn ($query) => (
            $query->where('name', 'LIKE', "%{$term}%")
                ->orWhere('description', 'LIKE', "%{$term}%")
            ))
            ->get();
    }
}
