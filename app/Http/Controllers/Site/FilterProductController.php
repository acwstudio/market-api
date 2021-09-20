<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\FilterCollection;
use App\Models\City;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Level;
use App\Models\Organization;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class FilterProductController extends Controller
{
    public function catalog(Request $request)
    {
        $response = [
            [
                'title'     => 'Направления',
                'filter_by' => 'directions',
                'type'      => 'list',
                'search'    => false,
                'values'    => $this->getPublishedListByModel(Direction::class),
            ],
            [
                'title'     => 'Уровни',
                'filter_by' => 'levels',
                'type'      => 'list',
                'search'    => false,
                'values'    => $this->getPublishedListByModel(Level::class),
            ],
            [
                'title'     => 'Форматы',
                'filter_by' => 'formats',
                'type'      => 'list',
                'search'    => false,
                'values'    => $this->getPublishedListByModel(Format::class),
            ],
            [
                'title'     => 'Учебные заведения',
                'filter_by' => 'organization_id',
                'type'      => 'list',
                'search'    => true,
                'values'    => $this->getPublishedListByModel(Organization::class),
            ],
            [

                'title'     => 'С трудоустройством',
                'filter_by' => 'is_employment',
                'type'      => 'checkbox',
                'search'    => true,
                'values'    => [true, false]
            ],
            [
                'title'     => 'В рассрочку',
                'filter_by' => 'is_installment',
                'type'      => 'checkbox',
                'search'    => true,
                'values'    => [true, false]
            ],
            [
                'title'     => 'Города',
                'filter_by' => 'city_ids',
                'type'      => 'list',
                'search'    => true,
                'values'    => $this->getListByModel(City::class),
            ]
        ];

        return response()->json([
            'success' => true,
            'data'    => new FilterCollection($response)
        ]);
    }

    private function getPublishedListByModel($model)
    {
        return QueryBuilder::for($model)
            ->select('id', 'name')
            ->where('published', 1)
            ->get();
    }

    private function getListByModel($model)
    {
        return QueryBuilder::for($model)
            ->select('id', 'name')
            ->get();
    }
}