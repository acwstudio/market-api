<?php

use App\Http\Controllers\Site\FilterController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\Site\MenuController;
use App\Http\Controllers\Site\ProductSectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\SubjectController;

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

Route::group(['prefix' => '/v1'], function () {
    Route::get('test', [TestController::class, 'test']);

    Route::get('products/list', [ProductController::class, 'list']);
    Route::get('products/detail', [ProductController::class, 'detail']);
    Route::get('persons/list', [PersonController::class, 'list']);
    Route::get('persons/detail', [PersonController::class, 'detail']);
    Route::get('directions/list', [DirectionController::class, 'list']);
    Route::get('directions/detail', [DirectionController::class, 'detail']);
    Route::get('organizations/list', [OrganizationController::class, 'list']);
    Route::get('organizations/detail', [OrganizationController::class, 'detail']);
    Route::get('formats/list', [FormatController::class, 'list']);
    Route::get('formats/detail', [FormatController::class, 'detail']);
    Route::get('subjects/list', [SubjectController::class, 'list']);
    Route::get('subjects/detail', [SubjectController::class, 'detail']);
    Route::get('filter', [FilterController::class, 'filter']);
    Route::get('menu', [MenuController::class, 'menu']);
    Route::get('products/sections/list', [ProductSectionController::class, 'list']);
    Route::get('products/sections/detail', [ProductSectionController::class, 'detail']);
});
