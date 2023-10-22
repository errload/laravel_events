<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\EventController;

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

Route::get('register', [RegisterController::class, 'store']);
Route::get('login', [LoginController::class, 'login']);
Route::get('event/store', [EventController::class, 'store']);
Route::get('event/get_list', [EventController::class, 'getList']);
Route::get('event/apply/{id}', [EventController::class, 'applyEvent']);
Route::get('event/cancel/{id}', [EventController::class, 'cancelEvent']);
Route::get('event/delete/{id}', [EventController::class, 'delete']);
