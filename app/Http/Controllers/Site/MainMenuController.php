<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\MainMenuResource;
use App\Models\Direction;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Productable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\QueryBuilder;

class MainMenuController extends Controller
{
    public function menu(Request $request)
    {
        $cacheOptions = $this->getCacheOptions();
        
        return Cache::remember($cacheOptions['key'], $cacheOptions['time'], function() use ($request) {
            // Собираем все опубликованные direction'ы и готовим шаблоны для использования в выдаче
            $directions = Direction::where('published', 1)->get();
            $directionsTemplate = [];
            foreach ($directions as $direction) {
                $directionsTemplate[$direction->id] = [
                    'id'       => $direction->id,
                    'anchor'   => $direction->name,
                    'link'     => "/catalog?%s_ids=%d&direction_ids=$direction->id",
                    'products' => []
                ];
            }
            
            // Собираем все опубликованные product'ы и готовим шаблоны для использования в выдаче
            $products = Product::where('published', 1)->get();
            $productsTemplate = [];
            foreach ($products as $product) {
                $productsTemplate[$product->id] = [
                    'id'     => $product->id,
                    'anchor' => $product->name,
                    'link'   => "/products/$product->slug"
                ];
            }
            
            // Собираем массив, содержащий связь в формате direction_id => [ product_ids... ]
            // При этом исключаем direction'ы и product'ы, не попавшие в массивы выше
            $productables = Productable::where('productable_type', Direction::class)->get();
            $directionProducts = [];
            foreach ($productables as $productable) {
                if (isset($directionsTemplate[$productable->productable_id]) && isset($productsTemplate[$productable->product_id])) {
                    $directionProducts[$productable->productable_id][] = $productable->product_id;
                }
            }
            
            // Один раз отдаем информацию классу ресурса, чтобы не производить одни и те же вычисления внутри него
            MainMenuResource::$directionsTemplate = &$directionsTemplate;
            MainMenuResource::$productsTemplate = &$productsTemplate;
            MainMenuResource::$directionProducts = &$directionProducts;
            
            $query = QueryBuilder::for(Menu::class)
                ->where('active', true)
                ->get();

            return response()->json([
                'data'    => MainMenuResource::collection($query),
                'success' => true,
                'count'   => $query->count()
            ]);
        });
    }

    private function getCacheOptions()
    {
        return config('api.cache')['main-menu'];
    }
}
