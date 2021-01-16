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

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index']);
Route::get('/admin/{any}', [\App\Http\Controllers\AdminController::class, 'index'])->where('any', '.*');;
Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('home');

Auth::routes();
