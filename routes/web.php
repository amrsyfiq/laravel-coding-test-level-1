<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ExternalApiController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('event', EventController::class)->middleware('auth');
Route::get('/external', [ExternalApiController::class, 'index']);

Route::get('/search/', [EventController::class, 'search'])->name('search');
