<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\MainMenuResource;
use App\Models\Direction;
use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class MainMenuController extends Controller
{
    public function menu(Request $request)
    {
        $query = QueryBuilder::for(Menu::class)
            ->where('active', true)
            ->with('menuable')
            ->get();
//        $productIds = Menu::find(1)->menuable->products->pluck('id');
//        $directions = Direction::all();
//        return Menu::find(1)->menuable->first()->morphedToMany();
//        return Menu::find(1)->menuable->products->pluck('id');
        return (MainMenuResource::collection($query))
            ->additional([
                'success' => true,
                'count' => $query->count()
            ]);
    }
}
