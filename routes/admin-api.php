<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Laravue\JsonResponse;
use \App\Laravue\Acl;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\Api\AuthController;
use App\Http\Controllers\Admin\Api\UserController;
use App\Http\Controllers\Admin\Api\HomeController;
use App\Http\Controllers\Admin\Api\ModeratorController;
use App\Http\Controllers\Admin\Api\ApiAccountController;
use App\Http\Controllers\Admin\Api\SortController;
use App\Http\Controllers\Admin\Api\SettingController;
use App\Http\Controllers\Admin\Api\MenuController;
use App\Http\Controllers\Admin\Api\CheckApiController;
use App\Http\Controllers\Admin\Api\CheckSystemController;
use App\Http\Controllers\Admin\Api\CheckUniqueController;
use App\Http\Controllers\Admin\Api\ReportController;
use App\Http\Controllers\Admin\Api\PromoCodeController;
use App\Http\Controllers\Admin\Api\BlockListController;
use App\Http\Controllers\Admin\Api\ContentBlockController;
use App\Http\Controllers\Admin\Api\RewriteController;
use App\Http\Controllers\Admin\Api\ServiceController;
use App\Http\Controllers\Admin\Api\ArticleController;
use App\Http\Controllers\Admin\Api\StaticPageController;
use App\Http\Controllers\Admin\Api\ContactOrderController;
use App\Http\Controllers\Admin\Api\PermissionController;
use App\Http\Controllers\Admin\Api\PageController;
use App\Http\Controllers\Admin\Api\RemoveUniqueFilesController;
use App\Http\Controllers\Admin\Api\CheckUniqueServiceStatisticController;

Route::post('auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/user/{id}/profile', [UserController::class, 'show']);
    Route::post('/user/{id}/change-password', [UserController::class,'changePassword']);
    Route::post('/user/{id}/update', [UserController::class,'update']);
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::apiResource('/moderators', ModeratorController::class);
    Route::apiResource('/api-accounts', ApiAccountController::class);
    Route::post('/sort', [SortController::class, 'sort'])->name('sorting');
    Route::get('/setting/get', [SettingController::class, 'getSettings'])->name('setting.index');
    Route::post('/setting/update', [SettingController::class, 'update'])->name('setting.update');
    Route::post('/setting/upload-favicon', [SettingController::class, 'uploadFavicon'])->name('setting.upload-favicon');
    Route::post('/menu/store',[MenuController::class, 'store'])->name('menu.store');
    Route::post('/menu/{id}/update', [MenuController::class, 'update'])->name('menu.update');
    Route::post('/menu/{id}/remove',[MenuController::class, 'remove'])->name('menu.remove');
    Route::get('/menu/get/{position}',[MenuController::class, 'list'])->name('menu.list');
    Route::post('/menu/{position}/sort',[MenuController::class, 'sort'])->name('menu.sort');
    Route::get('/check-api/list',[CheckApiController::class, 'index'])->name('check-api.list');
    Route::post('/check-api/{id}/update', [CheckApiController::class, 'update'])->name('check-api.update');
    Route::get('/check-systems',[CheckSystemController::class, 'index'])->name('check-systems.index');
    Route::get('/check-system/{id}/show',[CheckSystemController::class, 'show'])->name('check-systems.show');
    Route::post('/check-system/store',[CheckSystemController::class, 'store'])->name('check-systems.store');
    Route::post('/check-system/{id}/update',[CheckSystemController::class, 'update'])->name('check-systems.update');
    Route::post('/check-system/{id}/destroy',[CheckSystemController::class, 'destroy'])->name('check-systems.destroy');
    Route::get('/check-uniques', [CheckUniqueController::class, 'index'])->name('check-unique.index');
    Route::get('/check-unique/systems', [CheckUniqueController::class, 'getSystems'])->name('check-unique.systems');
    Route::get('/check-unique/{id}/show', [CheckUniqueController::class, 'show']);
    Route::post('/report/{id}/send', [ReportController::class, 'sendReport']);
    Route::apiResource('/promo-codes', PromoCodeController::class);
    Route::apiResource('block-lists', BlockListController::class)->except([
        'update'
    ]);
    Route::put('/block-lists/{block_list}', [BlockListController::class,'updateTitle'])->name('block-lists.update-title');
    Route::post('/block-lists/{block_list}/store-item', [BlockListController::class,'storeItem'])->name('block-lists.store-item');
    Route::put('/block-lists/{block_list}/edit-item', [BlockListController::class,'updateItem'])->name('block-lists.edit-item');
    Route::delete('/block-lists/{block_list}/delete-item', [BlockListController::class,'destroyItem'])->name('block-lists.destroy-item');
    Route::post('/block-lists/{block_list}/sort', [BlockListController::class, 'sort'])->name('block-lists.sort');
    Route::get('/content-block/{type}/list', [ContentBlockController::class, 'getList'])->name('content-block.list');
    Route::get('/content-block/{type}', [ContentBlockController::class, 'show'])->name('content-block.show');
    Route::post('/content-block/{type}/store', [ContentBlockController::class, 'store'])->name('content-block.store');
    Route::put('/content-block/{id}/update', [ContentBlockController::class, 'update'])->name('content-block.update');
    Route::delete('/content-block/{id}/delete', [ContentBlockController::class, 'destroy'])->name('content-block.destroy');
    Route::get('/rewrites', [RewriteController::class, 'index'])->name('rewrites');
    Route::get('/rewrite/{id}', [RewriteController::class, 'show'])->name('rewrite.show');
    Route::put('/rewrite/{id}', [RewriteController::class, 'update'])->name('rewrite.update');
    Route::get('/services', [ServiceController::class,'index'])->name('services');
    Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');
    Route::post('/service', [ServiceController::class, 'store'])->name('service.store');
    Route::put('/service/{id}', [ServiceController::class,'update'])->name('service.update');
    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::post('/service/{id}/delete-logo', [ServiceController::class, 'deleteLogo'])->name('service.delete-logo');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
    Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
    Route::post('/article', [ArticleController::class,'store'])->name('article.store');
    Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
    Route::get('/static-pages', [StaticPageController::class, 'index'])->name('static-page');
    Route::get('/static-page/{id}', [StaticPageController::class, 'show'])->name('static-page.show');
    Route::post('/static-page', [StaticPageController::class, 'store'])->name('static.page.store');
    Route::put('/static-page/{id}', [StaticPageController::class, 'update'])->name('static.page.update');
    Route::delete('/static-page/{id}', [StaticPageController::class, 'destroy'])->name('static.page.destroy');
    Route::get('/contact-order', [ContactOrderController::class, 'index'])->name('contacts');
    Route::get('/contact-order/{id}', [ContactOrderController::class, 'show'])->name('contact.show');
    Route::post('/remove-unique-files', [RemoveUniqueFilesController::class, 'remove'])->name('remove.unique.files');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/page', [PageController::class, 'show'])->name('page');
    Route::post('/page/{id}/update', [PageController::class, 'update'])->name('page.update');
    Route::get('/check-unique-service-statistic/services', [CheckUniqueServiceStatisticController::class, 'services'])
        ->name('check-unique-service-statistic.services');
    Route::get('/check-unique-service-statistic/symbols', [CheckUniqueServiceStatisticController::class, 'symbolsStatistic'])
        ->name('check-unique-service-statistic');
});


