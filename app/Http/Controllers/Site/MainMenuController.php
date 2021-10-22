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
    const BANNER_ID = 3;

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
            $productsTemplate = [];

            // @todo OGM-1034: Ужасный костыль, связанный с тем, что на проде сейчас используется устаревшая версия БД (MariaDB 10.4.12),
            //       которая не поддерживает ANY_VALUE, и sql_mode=only_full_group_by, запрещающий "голые" GROUP BY.
            $products = Product::where(Product::FIELD_PUBLISHED, 1)->get();
            $usedProductNames = [];
            foreach ($products as $product) {
                if (!in_array($product->name, $usedProductNames)) {
                    $productsTemplate[$product->id] = [
                        'id'     => $product->id,
                        'anchor' => $product->name,
                        'link'   => "/product/$product->slug"
                    ];
                    $usedProductNames[] = $product->name;
                }
            }
            // @todo OGM-1034: после обновления БД удалить код выше и раскомментировать код ниже.
            // $products = Product::selectRaw(sprintf('ANY_VALUE(`%1$s`) AS `%1$s`, `%2$s`, ANY_VALUE(`%3$s`) as `%3$s`', Product::FIELD_ID, Product::FIELD_NAME, Product::FIELD_SLUG))
            //                   ->where(Product::FIELD_PUBLISHED, 1)
            //                   ->groupBy(Product::FIELD_NAME)
            //                   ->get();
            // foreach ($products as $product) {
            //     $productsTemplate[$product->id] = [
            //         'id'     => $product->id,
            //         'anchor' => $product->name,
            //         'link'   => "/product/$product->slug"
            //     ];
            // }
            
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
                'data' => [
                    'list' => MainMenuResource::collection($query),
                    'banner_id' => self::BANNER_ID
                ],
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
