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


use App\Http\Controllers\Site\Api\CheckUniqueController;
Route::get('/check-unique/{id}/show', [CheckUniqueController::class, 'show'])
    ->name('check-unique.show');
Route::post('/check-unique/validate-modal', [CheckUniqueController::class, 'validateCheckUniqueModal'])
    ->name('check-unique.validate-modal');
Route::post('/check-unique', [CheckUniqueController::class, 'check'])
    ->name('check-unique');
Route::post('/check-unique-file', [CheckUniqueController::class, 'checkFile'])
    ->name('check-unique-file');
Route::post('/check-unique-make-report', [CheckUniqueController::class, 'makeReport'])
    ->name('check-unique-report');


use App\Http\Controllers\Site\Api\ContactController;
Route::post('/contact/consultation', [ContactController::class,'consultation'])->name('contact.consultation');

use App\Http\Controllers\Site\Api\ReportController;
Route::get('/report/{id}/show', [ReportController::class, 'show'])->name('report.show');
Route::post('/report/{id}/uid', [ReportController::class, 'getUid'])->name('report.get-uid');
Route::post('/report/{id}/result', [ReportController::class, 'getResult'])->name('report.get-result');
Route::post('/report/{id}/download', [ReportController::class, 'downloadPdf'])->name('report.download');
Route::post('/report/{id}/send-email', [ReportController::class, 'sendEmail'])->name('report.send-email');
Route::post('/report/{id}/highlight', [ReportController::class, 'highlightUrl'])->name('report.highlight');

use App\Http\Controllers\Site\Api\CheckSystemController;
Route::get('/check-systems', [CheckSystemController::class, 'index'])->name('check-systems.list');

use App\Http\Controllers\Site\Api\PaymentController;
Route::post('check-unique-payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('check-robokassa-payment', [PaymentController::class, 'robokassaPayment'])->name('robokassa-payment');
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
Route::post('/unique-order/payment-free', [UniqueOrderController::class, 'storeFree'])
    ->name('unique-order.store-free');
Route::get('/unique-order/show/{id}', [UniqueOrderController::class, 'show'])
    ->name('unique-order.show');
use App\Http\Controllers\Site\Api\PayOnlineController;
Route::post('/validate-payment-form', [PayOnlineController::class, 'validatePaymentForm'])->name('validate-payment-form');

use App\Http\Controllers\Site\Api\CloudPaymentsController;
Route::post('/cloud-payment/success', [CloudPaymentsController::class, 'success'])
    ->name('cloud-payment.success');
use App\Http\Controllers\Site\Api\VkontakteController;
Route::post('/vk-post', [VkontakteController::class, 'wallPost']);
