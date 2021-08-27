<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\MenuCollection;
use App\Http\Resources\Site\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MenuController extends Controller
{
    public function menu()
    {
        $query = QueryBuilder::for(Menu::class)
            ->allowedFilters([
                AllowedFilter::exact('active')->default(true),
            ])
            ->defaultSort('pointer')
            ->allowedSorts(['pointer', 'id'])
            ->get();

        return new MenuCollection($query);
    }
}
