<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Search\SearchRepository;
use Illuminate\Database\Eloquent\Collection;

class SearchProductController extends Controller
{
    public function list(SearchRepository $searchRepository): Collection|array
    {
        $product = Product::class;

        return request()->has('query')
                ? $searchRepository->search($product, request('query'))
                : Product::all();
    }
}
