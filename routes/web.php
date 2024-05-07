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

use App\Http\Controllers\Site\MainPageController;
Route::get('/', [MainPageController::class, 'show'])->name('main-page');
Route::get('/pdf/{id}', [MainPageController::class, 'reviewPdf']) ->name('main-page.pdf');
Route::get('/admin/login')->name('login');
use App\Http\Controllers\Site\CheckReportController;
Route::get('/report/{slug}', [CheckReportController::class, 'show'])->name('report');

use App\Http\Controllers\Site\AboutController;
Route::get('/about', [AboutController::class, 'show'])->name('about-page');
Route::get('/price', function () {
    $page = \App\Models\Page::where('slug', 'price')->firstOrFail();
    $seo = $page->seo;
    return view('site.price.index', ['seo' => $seo]);
});
Route::get('/reviews', function () {
    $page = \App\Models\Page::where('slug', 'reviews')->firstOrFail();
    $seo = $page->seo;
    return view('site.reviews.index', ['seo' => $seo]);
});
Route::get('/faq', function () {
    $page = \App\Models\Page::where('slug', 'faq')->firstOrFail();
    $seo = $page->seo;
    return view('site.faq.index', ['seo' => $seo]);
});
Route::get('/contact', function () {
    return view('site.contact.index');
});
use App\Http\Controllers\Site\ArticleController;
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('article.show');

use App\Http\Controllers\Site\UnitPayController;
Route::get('/unitpay/result', [UnitPayController::class, 'handlePayment']);
Route::get('/unitpay/result-netting', [UnitPayController::class, 'handlePaymentNetting']);
use App\Http\Controllers\Site\UniqueOrderController;
Route::get('/order/success', [UniqueOrderController::class, 'success'])->name('order.success');
Route::get('/order/fail', [UniqueOrderController::class, 'fail'])->name('order.fail');
Route::get('/robokassa-success', [UniqueOrderController::class, 'robokassaSuccess']);
Route::get('/robokassa-fail', [UniqueOrderController::class, 'robokassaFail']);
Route::get('/order/test', [UniqueOrderController::class, 'test']);


use App\Http\Controllers\Site\TestMailController;
Route::get('/mailable', [TestMailController::class,'testMail']);
//Route::get('/mailable/send', [TestMailController::class, 'sendTestMail']);
//use App\Http\Controllers\Site\ViewNotificationTemplateController;
//Route::get('/payment-mail',[ViewNotificationTemplateController::class, 'needPaymentNotification']);

//use App\Http\Controllers\Site\VkController;
//Route::get('/vk', [VkController::class, 'index']);

//use App\Http\Controllers\Site\CheckUniqueTestController;
//Route::get('/check-test', [CheckUniqueTestController::class, 'checkTest']);
//use App\Http\Controllers\Site\TestPdfController;
//Route::get('/test-pdf', [TestPdfController::class, 'index']);
//Route::get('/test-pdf2', [TestPdfController::class, 'test']);
use App\Http\Controllers\Site\SiteMapController;
Route::get('/sitemap.xml', [SiteMapController::class, 'index']);
use App\Http\Controllers\Site\StaticPageController;
Route::get('{path}', [StaticPageController::class, 'show'])->where('path', '[0-9A-Za-zА-Яа-я\/\.-]+') ->name('static-page');




