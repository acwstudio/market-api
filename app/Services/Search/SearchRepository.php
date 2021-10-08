<?php

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Collection;

interface SearchRepository
{
    public function search(string $model, string $query): Collection;
}
