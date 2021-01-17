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

Route::get('/reports', [\App\Http\Controllers\Api\ReportsController::class, 'index']);

Route::get('/users', [\App\Http\Controllers\Api\UsersController::class, 'index']);
Route::post('/users', [\App\Http\Controllers\Api\UsersController::class, 'store']);
Route::post('/users/{id}', [\App\Http\Controllers\Api\UsersController::class, 'update']);
Route::delete('/users/{id}', [\App\Http\Controllers\Api\UsersController::class, 'destroy']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
