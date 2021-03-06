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
Route::get('/articles', function () {
    return view('site.articles.index');
});


