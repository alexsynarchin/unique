<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Admin\Auth\LoginController;
Route::post('/logout',[LoginController::class, 'logout']) -> name('logout');

use App\Http\Controllers\Admin\Api\ModeratorController;

Route::apiResource('/moderators', ModeratorController::class);

use App\Http\Controllers\Admin\Api\SettingController;
Route::get('/setting/common/get', [SettingController::class, 'getCommon'])->name('setting.get-common');
Route::post('/setting/common-update', [SettingController::class, 'updateCommon'])->name('setting.update-common');

use App\Http\Controllers\Admin\Api\MenuController;
Route::post('/menu/store',[MenuController::class, 'store'])->name('menu.store');
Route::post('/menu/{id}/update', [MenuController::class, 'update'])->name('menu.update');
Route::post('/menu/{id}/remove',[MenuController::class, 'remove'])->name('menu.remove');
Route::get('/menu/get/{position}',[MenuController::class, 'list'])->name('menu.list');

use App\Http\Controllers\Admin\Api\CheckApiController;
Route::get('/check-api/list',[CheckApiController::class, 'index'])->name('check-api.list');
Route::post('/check-api/{id}/update', [CheckApiController::class, 'update'])->name('check-api.update');

use App\Http\Controllers\Admin\Api\CheckSystemController;

Route::get('/check-systems',[CheckSystemController::class, 'index'])->name('check-systems.index');
Route::get('/check-system/{id}/show',[CheckSystemController::class, 'show'])->name('check-systems.show');
Route::post('/check-system/store',[CheckSystemController::class, 'store'])->name('check-systems.store');
Route::post('/check-system/{id}/update',[CheckSystemController::class, 'update'])->name('check-systems.update');
Route::post('/check-system/{id}/destroy',[CheckSystemController::class, 'destroy'])->name('check-systems.destroy');

use App\Http\Controllers\Admin\Api\CheckUniqueController;
Route::get('/check-uniques', [CheckUniqueController::class, 'index'])->name('check-unique.index');

use App\Http\Controllers\Admin\Api\PromoCodeController;
Route::apiResource('/promo-codes', PromoCodeController::class);

