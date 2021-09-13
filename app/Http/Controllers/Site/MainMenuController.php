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

        return (MainMenuResource::collection($query))
            ->additional([
                'success' => true,
                'count' => $query->count()
            ]);
    }
}
