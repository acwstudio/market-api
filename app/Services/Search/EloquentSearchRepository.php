<?php

namespace App\Services\Search;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class EloquentSearchRepository implements SearchRepository
{
    public function search(string $term): Collection
    {
        return Product::query()
            ->where(fn ($query) => (
            $query->where('name', 'LIKE', "%{$term}%")
                ->orWhere('description', 'LIKE', "%{$term}%")
            ))
            ->get();
    }
}
