<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AuthController;
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
Route::group(['prefix'=>'v1'], function () {

    Route::group(['prefix'=>'auth'], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::group(['prefix'=>'cabinet'], function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });
        Route::apiResource('characters', CharacterController::class);
        Route::group(['prefix' => 'characters'], function () {
            Route::get('{id}/episodes', [CharacterController::class, 'getEpisodes']);
        });
        Route::apiResource('images', ImageController::class)->only(['store', 'destroy']);
        Route::apiResource('locations', LocationController::class);
        Route::apiResource('episodes', EpisodeController::class);
        Route::group(['prefix' => 'episodes'], function () {
            Route::post('{id}/image', [EpisodeController::class, 'storeImage']);
            Route::delete('{id}/image', [EpisodeController::class, 'destroyImage']);
            Route::get('{id}/characters', [EpisodeController::class, 'getCharacters']);
            Route::post('{id}/characters', [EpisodeController::class, 'attachCharacter']);
            Route::delete('{id}/characters/{characterId}', [EpisodeController::class, 'detachCharacter']);
        });
    });

});
