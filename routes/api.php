<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Http\Controllers\Site\Api\CheckUniqueController;
Route::get('/check-unique/{id}/show', [CheckUniqueController::class, 'show'])->name('check-unique.show');
Route::post('/check-unique', [CheckUniqueController::class, 'check'])->name('check-unique');
Route::post('/check-unique-file', [CheckUniqueController::class, 'checkFile'])->name('check-unique-file');
Route::post('/check-unique-make-report', [CheckUniqueController::class, 'makeReport'])->name('check-unique-report');

use App\Http\Controllers\Site\Api\ContactController;
Route::post('/contact/consultation', [ContactController::class,'consultation'])->name('contact.consultation');

use App\Http\Controllers\Site\Api\ReportController;
Route::get('/report/{id}/show', [ReportController::class, 'show'])->name('report.show');
Route::post('/report/{id}/uid', [ReportController::class, 'getUid'])->name('report.get-uid');
Route::post('/report/{id}/result', [ReportController::class, 'getResult'])->name('report.get-result');
Route::post('/report/{id}/download', [ReportController::class, 'downloadPdf'])->name('report.download');
Route::post('/report/{id}/send-email', [ReportController::class, 'sendEmail'])->name('report.send-email');

use App\Http\Controllers\Site\Api\CheckSystemController;
Route::get('/check-systems', [CheckSystemController::class, 'index'])->name('check-systems.list');

use App\Http\Controllers\Site\Api\PaymentController;
Route::post('check-unique-payment', [PaymentController::class, 'payment'])->name('payment');

use App\Http\Controllers\Site\Api\BlockListController;
Route::get('/block-list/{type}',[BlockListController::class,'index'])->name('block-list');

use App\Http\Controllers\Site\Api\ReviewController;
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

use App\Http\Controllers\Site\Api\RewriteController;
Route::post('/rewrite/order', [RewriteController::class, 'order']) -> name('rewrite.order');

use App\Http\Controllers\Site\Api\ServiceController;
Route::get('/services', [ServiceController::class, 'index'])->name('services');

use App\Http\Controllers\Site\Api\NavController;
Route::get('/navigation/{position}', [NavController::class, 'getMenu'])->name('navigation');

use App\Http\Controllers\Site\Api\SettingController;
Route::get('/setting/{group}/{name}', [SettingController::class, 'getSetting'])->name('setting.value');

use App\Http\Controllers\Site\Api\ArticleController;
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');

use App\Http\Controllers\Site\Api\UniqueOrderController;
Route::post('/unique-order/payment', [UniqueOrderController::class, 'store'])->name('unique-order.store');
