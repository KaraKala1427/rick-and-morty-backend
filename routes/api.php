<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\IndexController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
    Route::apiResource('characters',CharacterController::class);

});

//Route::get('/characters', [CharacterController::class,'getCharacters']);
//Route::get('/characters/{characterId}', [CharacterController::class,'getCharacterById']);
//Route::post('/characters/', [CharacterController::class,'createCharacter']);
//Route::put('/characters/{characterId}', [CharacterController::class,'updateCharacter']);
//Route::delete('/characters/{characterId}', [CharacterController::class,'deleteCharacter']);
