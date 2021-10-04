<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppCollection;
use App\Http\Resources\AppResource;
use App\Models\App;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class AppController extends Controller
{
    public function site(Request $request)
    {
        $query = QueryBuilder::for(App::class)->where('app', 'site')->get();

        return (new AppResource($query))->additional([
            'success' => true
        ]);
    }
}
