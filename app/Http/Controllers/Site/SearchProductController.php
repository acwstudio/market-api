<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Search\SearchRepository;
use Illuminate\Http\Request;

class SearchProductController extends Controller
{
    public function list(SearchRepository $searchRepository)
    {
        return request()->has('query')
                ? $searchRepository->search(request('query'))
                : Product::all();
    }
}
