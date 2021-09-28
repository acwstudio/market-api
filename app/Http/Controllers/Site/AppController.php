<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function app(Request $request)
    {
        return response()->json([
            'success' => true,
            'data'    => config('methods.app.site')
        ]);
    }
}
