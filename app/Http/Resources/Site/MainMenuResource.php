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
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $explodeEntity = explode('\\', $this->model);
        $entity = strtolower(end($explodeEntity));

        //  id продуктов принадлежащих данному пункту меню
        $idsProducts = $this->menuable->products->pluck('id')->toArray();
        //  находим все эти продукты
        $products = Product::find($idsProducts);

        // создаем пустую коллекцию для directions
        $directions = collect();

        foreach ($products as $product) {
            foreach ($product->directions as $direction) {

                //  выбираем продукты конкретного направления
                $directionProducts = Product::whereHas('directions', function ($q) use ($direction) {
                    $q->where('id', $direction['id']);
                })->whereIn('id', $idsProducts)->get();

                //  Выбираем нужные поля продуктов
                $resourceProducts = $directionProducts->map(function ($item){
                    return [
                        'id' => $item->id,
                        'anchor' => $item->name,
                        'link' => "/product/$item->slug"
                    ];
                });

                //  собираем массив направлений и вложенные в направления продукты
                $directions = $directions->push([

                    'id' => $direction->id,
                    'anchor' => $direction->name,
                    'link' => "/catalog/$entity/$this->model_id/direction/$direction->id",
                    'products' => $resourceProducts

                ])->unique();
            }
        }

        return [
            'id' => $this->id,
            'anchor' => $this->anchor ?: $this->menuable->name,
            'link' => "/catalog/$entity/$this->model_id",
            'sub_items' => $directions
        ];
    }
}
