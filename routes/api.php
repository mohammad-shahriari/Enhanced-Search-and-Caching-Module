<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'movie'], function () {
    Route::get('/index', [\App\Http\Controllers\MovieController::class,'index']);
    Route::post('/create', [\App\Http\Controllers\MovieController::class,'store']);
    Route::put('/update/{id}', [\App\Http\Controllers\MovieController::class,'update']);
    Route::delete('/delete/{id}', [\App\Http\Controllers\MovieController::class,'destroy']);
});


Route::group(['prefix' => 'crew'], function () {
    Route::get('/index', [\App\Http\Controllers\CrewController::class,'index']);
    Route::post('/create', [\App\Http\Controllers\CrewController::class,'store']);
    Route::put('/update/{id}', [\App\Http\Controllers\CrewController::class,'update']);
    Route::delete('/delete/{id}', [\App\Http\Controllers\CrewController::class,'destroy']);
});


Route::group(['prefix' => 'genre'], function () {
    Route::get('/index', [\App\Http\Controllers\GenreController::class,'index']);
    Route::post('/create', [\App\Http\Controllers\GenreController::class,'store']);
    Route::put('/update/{id}', [\App\Http\Controllers\GenreController::class,'update']);
    Route::delete('/delete/{id}', [\App\Http\Controllers\GenreController::class,'destroy']);
});
