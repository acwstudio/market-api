<?php

use App\Http\Controllers\Site\EntitySectionController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\FilterController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\Site\MainMenuController;
use App\Http\Controllers\Site\MenuController;
use App\Http\Controllers\Site\PageSectionController;
use App\Http\Controllers\Site\ProductSectionController;
use App\Http\Controllers\Site\OrganizationSectionController;
use App\Http\Controllers\Site\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
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
    Route::post('page', [PageController::class, 'page']);

    Route::post('products/list', [ProductController::class, 'list']);
    Route::post('products/detail', [ProductController::class, 'detail']);
    Route::post('persons/list', [PersonController::class, 'list']);
    Route::post('persons/detail', [PersonController::class, 'detail']);
    Route::post('banners/list', [BannerController::class, 'list']);
    Route::post('banners/detail', [BannerController::class, 'detail']);
    Route::post('directions/list', [DirectionController::class, 'list']);
    Route::post('directions/detail', [DirectionController::class, 'detail']);
    Route::post('organizations/list', [OrganizationController::class, 'list']);
    Route::post('organizations/detail', [OrganizationController::class, 'detail']);
    Route::post('formats/list', [FormatController::class, 'list']);
    Route::post('formats/detail', [FormatController::class, 'detail']);
    Route::post('subjects/list', [SubjectController::class, 'list']);
    Route::post('subjects/detail', [SubjectController::class, 'detail']);
    Route::post('filter', [FilterController::class, 'filter']);
    Route::post('menu', [MenuController::class, 'menu']);
    Route::post('menu/main', [MainMenuController::class, 'menu']);
    Route::post('products/sections/list', [ProductSectionController::class, 'list']);
    Route::post('products/sections/detail', [ProductSectionController::class, 'detail']);
    Route::post('organizations/sections/list', [OrganizationSectionController::class, 'list']);
    Route::post('organizations/sections/detail', [OrganizationSectionController::class, 'detail']);
    Route::post('quizzes/list', [QuizController::class, 'list']);
    Route::post('quizzes/detail', [QuizController::class, 'detail']);
    Route::post('pages/sections/detail', [PageSectionController::class, 'detail']);
    Route::post('entities/sections/list', [EntitySectionController::class, 'list']);
    Route::post('entities/sections/detail', [EntitySectionController::class, 'detail']);

    Route::post('/test/api', [TestController::class, 'api']);
});
