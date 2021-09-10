<?php

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
    Route::get('page', [PageController::class, 'page']);

    Route::get('products/list', [ProductController::class, 'list']);
    Route::get('products/detail', [ProductController::class, 'detail']);
    Route::get('persons/list', [PersonController::class, 'list']);
    Route::get('persons/detail', [PersonController::class, 'detail']);
    Route::get('banners/list', [BannerController::class, 'list']);
    Route::get('banners/detail', [BannerController::class, 'detail']);
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
    Route::get('menu/main', [MainMenuController::class, 'menu']);
    Route::get('products/sections/list', [ProductSectionController::class, 'list']);
    Route::get('products/sections/detail', [ProductSectionController::class, 'detail']);
    Route::get('organizations/sections/list', [OrganizationSectionController::class, 'list']);
    Route::get('organizations/sections/detail', [OrganizationSectionController::class, 'detail']);
    Route::get('quizzes/list', [QuizController::class, 'list']);
    Route::get('quizzes/detail', [QuizController::class, 'detail']);
    Route::get('pages/sections/detail', [PageSectionController::class, 'detail']);

    Route::post('/test/api', [TestController::class, 'api']);
});
