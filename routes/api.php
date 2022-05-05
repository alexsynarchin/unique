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
Route::post('/check-unique', [CheckUniqueController::class, 'check'])->name('check-unique');
Route::post('/check-unique-file', [CheckUniqueController::class, 'checkFile'])->name('check-unique-file');

use App\Http\Controllers\Site\Api\ContactController;
Route::post('/contact/consultation', [ContactController::class,'consultation'])->name('contact.consultation');
