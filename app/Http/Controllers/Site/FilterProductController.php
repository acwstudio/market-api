<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\FilterProductCatalogCollection;
use App\Models\City;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Level;
use App\Models\Organization;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Site\FilterProductCollection;
use App\Models\Subject;

class FilterProductController extends Controller
{
    public static $entities = [
        Direction::class,
        Level::class,
//        Format::class,
//        Subject::class
    ];

    public function main(Request $request)
    {
        $args = [];

        foreach (self::$entities as $ent) {
            $args[] = QueryBuilder::for($ent)->select('id', 'name')->where('published', 1)->get();
        }

        return (new FilterProductCollection($args))->additional([
            'success' => true
        ]);
    }

    /**
     * @todo need refactor
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function catalog(Request $request)
    {
        $resource = [
            [
                'title'     => 'Направления',
                'filter_by' => 'direction_ids',
                'type'      => 'list',
                'search'    => false,
                'values'    => $this->getPublishedListByModel(Direction::class),
            ],
            [
                'title'     => 'Уровни',
                'filter_by' => 'level_ids',
                'type'      => 'list',
                'search'    => false,
                'values'    => $this->getPublishedListByModel(Level::class),
            ],
            [
                'title'     => 'Форматы',
                'filter_by' => 'format_ids',
                'type'      => 'list',
                'search'    => false,
                'values'    => $this->getPublishedListByModel(Format::class),
            ],
            [
                'title'     => 'Учебные заведения',
                'filter_by' => 'organization_ids',
                'type'      => 'list',
                'search'    => true,
                'values'    => $this->getPublishedOrganizationListByModel(Organization::class),
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
            'data'    => new FilterProductCatalogCollection($resource)
        ]);
    }


    /**
     * @todo need refactor
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function presets(Request $request)
    {
        return response()->json([
            'success' => true,
            'data'    => config('methods.filters.presets')
        ]);
    }


    private function getPublishedListByModel($model)
    {
        return QueryBuilder::for($model)
            ->select('id', 'name', 'slug')
            ->where('published', 1)
            ->get();
    }

    private function getPublishedOrganizationListByModel($model)
    {
        return QueryBuilder::for($model)
            ->select('id', 'name', 'abbreviation_name', 'slug')
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
