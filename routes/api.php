<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\UserController;
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

Route::prefix('auth')->group(function () {
    Route::post('registration', [AuthController::class, 'registration']);
    Route::post('authorization', [AuthController::class, 'authorization']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('me', [UserController::class, 'getMe']);

        Route::get('list', [UserController::class, 'list']);
        Route::get('{user}', [UserController::class, 'get']);
    });

    Route::prefix('friends')->group(function () {
        Route::get('list', [FriendshipController::class, 'list']);

        Route::post('request/{user}', [FriendshipController::class, 'request']);
        Route::post('accept/{user}', [FriendshipController::class, 'accept']);
        Route::post('hide/{user}', [FriendshipController::class, 'hide']);
        Route::post('delete/{user}', [FriendshipController::class, 'delete']);
        Route::post('block/{user}', [FriendshipController::class, 'block']);
    });

    Route::prefix('servers')->group(function () {
        Route::post('create', [ServerController::class, 'create']);

        Route::prefix('{server}')->group(function () {
            Route::post('delete', [ServerController::class, 'delete']);
            Route::post('invite/{user}', [ServerController::class, 'invite']);
            Route::post('join', [ServerController::class, 'join']);
            Route::post('hide', [ServerController::class, 'hide']);

            Route::prefix('channel')->group(function () {
                Route::post('create', [ChannelController::class, 'create']);

                Route::prefix('{channel}')->group(function () {
                    Route::post('delete', [ChannelController::class, 'delete']);
                });
            });
        });
    });
});
