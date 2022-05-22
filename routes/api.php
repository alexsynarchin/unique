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
