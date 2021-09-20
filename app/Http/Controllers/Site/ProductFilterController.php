<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\ProductFilterCollection;
use App\Models\Direction;
use App\Models\Format;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductFilterController extends Controller
{
    public static $entities = [
        Direction::class,
        Level::class,
        Format::class,
        Subject::class
    ];
    
    public function filter(Request $request)
    {
        $args = [];
        
        foreach (self::$entities as $ent) {
            $args[] = QueryBuilder::for($ent)->select('id', 'name')->where('published', 1)->get();
        }
        
        return (new ProductFilterCollection($args))->additional([
            'success' => true
        ]);
    }
}
