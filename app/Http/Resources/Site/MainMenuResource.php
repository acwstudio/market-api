<?php

namespace App\Http\Resources\Site;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class MainMenuResource extends JsonResource
{

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'items';
    
    /**
     * @var array
     */
    public static $directionsTemplate;
    
    /**
     * @var array
     */
    public static $productsTemplate;
    
    /**
     * @var array
     */
    public static $directionProducts;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $model_id = $this->model_id;
        $menuable = $this->menuable;
        
        $entity = $menuable::MODEL_ENTITY;
        // Все продукты, относящиеся к текущему пункту меню
        $products = $menuable->products;
        
        // Массив direction'ов, который будет заполнен для текущего пункта меню
        $localDirections = [];
        
        foreach ($products as $product) {
            $productId = $product->id;
            
            foreach (self::$directionProducts as $directionId => $thisDirectionProducts) {
                // Ищем все direction'ы, которым принадлежит этот продукт
                if (in_array($productId, $thisDirectionProducts)) {
                    // Если direction еще не был добавлен в текущий массив, добавляем его
                    if (!isset($localDirections[$directionId])) {
                        $localDirection = self::$directionsTemplate[$directionId];
                        // Заполняем поле link по управляющей строке
                        $localDirection['link'] = sprintf($localDirection['link'], $entity, $model_id);
                        $localDirections[$directionId] = $localDirection;
                    }
                    
                    // Добавляем продукт в подмассив
                    $localDirections[$directionId]['products'][] = self::$productsTemplate[$productId];
                }
            }
        }
        
        ksort($localDirections);
        
        return [
            'id'        => $this->id,
            'anchor'    => $this->anchor ?? $menuable->name,
            'link'      => "/catalog?${entity}_ids=$model_id",
            'sub_items' => array_values($localDirections)
        ];
    }
}
