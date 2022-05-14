<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MoveController;

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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/userinfo/{id}', [AuthController::class, 'getUserInfoById']);
Route::group(['prefix' => 'user','as' => 'api.','namespace' => 'Api\User','middleware' => ['auth:sanctum']], function () {
    Route::get('/userinfo', [AuthController::class, 'getUserInfo']);
});


Route::group(['prefix' => 'game','as' => 'api.','namespace' => 'Api\Game','middleware' => ['auth:sanctum']], function () {
    Route::post('/create', [GameController::class, 'createGame']);
    Route::get('/get/{id}', [GameController::class, 'getGameInfo']);
    Route::post('/connect/{game_code}', [GameController::class, 'connectToGame']);
    Route::post('/usermove/{game_id}', [MoveController::class, 'userMove']);
    Route::post('/opponentmove/{game_id}', [MoveController::class, 'opponentMove']);
});