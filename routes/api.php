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


Route::group(['prefix' => 'movie'], function () {
    Route::get('/index', [\App\Http\Controllers\MovieController::class,'index']);
    Route::post('/create', [\App\Http\Controllers\MovieController::class,'store']);
    Route::put('/update/{id}', [\App\Http\Controllers\MovieController::class,'update'])->name('movie.update');
    Route::delete('/delete/{id}', [\App\Http\Controllers\MovieController::class,'destroy']);
    Route::get('/search', [\App\Http\Controllers\MovieController::class,'search']);
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
