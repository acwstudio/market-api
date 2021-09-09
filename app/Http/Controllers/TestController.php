<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Site\PageResource;

class TestController extends Controller
{
    public function web(Request $request)
    {
        dd('web', $request->all());
    }

    public function api(Request $request)
    {
        dd('api', $request->all());
    }
}
