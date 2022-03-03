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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('/user', [\App\Http\Controllers\Api\UserController::class, 'index'])->name("userIndex");
Route::get('/user/{id}', [\App\Http\Controllers\Api\UserController::class, 'show'])->where('id', '[0-9]+')->name("userShow");
Route::delete('/user/{id}', [\App\Http\Controllers\Api\UserController::class, 'destroy'])->where('id', '[0-9]+')->name("userDestroy");
Route::post('/user', [\App\Http\Controllers\Api\UserController::class, 'store'])->name("userStore");
Route::post('/user/{id}', [\App\Http\Controllers\Api\UserController::class, 'update'])->where('id', '[0-9]+')->name("userUpdate");


