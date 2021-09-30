<?php

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface SearchRepository
{
//    public function search(string $query): Collection;
    public function search(string $model, string $query): Collection;
}
