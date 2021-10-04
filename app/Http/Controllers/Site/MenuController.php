<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\MenuCollection;
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
                AllowedFilter::exact(Menu::FIELD_ACTIVE)->default(true),
            ])
            ->defaultSort(Menu::FIELD_POINTER)
            ->allowedSorts([Menu::FIELD_POINTER, Menu::FIELD_ID])
            ->get();
        
        return (new MenuCollection($query))
            ->additional([
                'count' => $query->count(),
                'success' => true
            ]);
    }
}
