<?php

namespace App\Http\Resources\Site;

use App\Models\Menu;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Menu $menu */
        $menu = $this->resource;
        return [
            Menu::FIELD_ID         => $menu->getId(),
            'type'                 => 'menus',
            Menu::FIELD_ACTIVE     => $menu->getActive(),
            Menu::FIELD_ANCHOR     => $menu->getAnchor() ? $menu->getAnchor() : $menu->menuable->name,
            Menu::FIELD_POINTER    => $menu->getSort(),
//            Menu::FIELD_CREATED_AT => $menu->getCreatedAt(),
//            Menu::FIELD_UPDATED_AT => $menu->getUpdatedAt(),
        ];
    }
}
