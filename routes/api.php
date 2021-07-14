<?php

use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\OrganizationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1'], function () {
    Route::get('test', [TestController::class, 'test']);

    Route::get('products/list', [ProductController::class, 'list']);
    Route::get('directions/list', [DirectionController::class, 'list']);
    Route::get('organizations/list', [OrganizationController::class, 'list']);

    Route::apiResource('courses', CourseController::class);
//    Route::get('courses', [CourseController::class, 'index']);
});
