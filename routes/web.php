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

use App\Http\Controllers\Admin\Auth\LoginController as AdminLogin;
Route::get('/admin-login', [AdminLogin::class, 'login']) -> middleware('admin-guest') -> name('admin.login');
Route::post('/admin/handle-login',[AdminLogin::class, 'handleLogin']) -> name('admin.handle-login');


use App\Http\Controllers\Site\CheckReportController;
Route::get('/report-{id}', [CheckReportController::class, 'show'])->name('report');

use App\Http\Controllers\Site\AboutController;
Route::get('/about', [AboutController::class, 'show'])->name('about-page');
Route::get('/price', function () {
    return view('site.price.index');
});
Route::get('/reviews', function () {
    return view('site.reviews.index');
});
Route::get('/faq', function () {
    return view('site.faq.index');
});
Route::get('/contact', function () {
    return view('site.contact.index');
});
use App\Http\Controllers\Site\ArticleController;
Route::get('/articles', function () {
    return view('site.articles.index');
});
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('article.show');

use App\Http\Controllers\Site\UnitPayController;
Route::get('/unitpay/result', [UnitPayController::class, 'handlePayment']);
Route::get('/unitpay/result-netting', [UnitPayController::class, 'handlePaymentNetting']);
use App\Http\Controllers\Site\UniqueOrderController;
Route::get('/order/success', [UniqueOrderController::class, 'success'])->name('order.success');
Route::get('/order/fail', [UniqueOrderController::class, 'fail'])->name('order.fail');

use App\Http\Controllers\Site\TestMailController;
Route::get('/mailable', [TestMailController::class,'testMail']);
Route::get('/mailable/send', [TestMailController::class, 'sendTestMail']);

Route::get('/get-permissions', function () {
    return auth()->check()?auth()->user()->jsPermissions():0;
});

use App\Http\Controllers\Site\StaticPageController;
Route::get('{path}', [StaticPageController::class, 'show'])->where('path', '[0-9A-Za-zА-Яа-я\/\.-]+') ->name('static-page');




