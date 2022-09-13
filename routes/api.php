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

Route::prefix('v1')->group(function () {
    Route::get('/events', [EventApiController::class, 'index']);
    Route::get('/events/active-events', [EventApiController::class, 'activeEvent']);
    Route::get('/events/{id}', [EventApiController::class, 'show']);
    Route::post('/events', [EventApiController::class, 'store']);
    Route::put('/events/{id}', [EventApiController::class, 'update']);
    Route::patch('/events/{id}', [EventApiController::class, 'patch']);
    Route::delete('/events/{id}', [EventApiController::class, 'destroy']);
});
