<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('adminlte', ['event' => null, 'users' => null]);
    })->name('home');

    Route::get('/event/{id}', [EventController::class, 'getEvent'])->name('get_event');
    Route::get('/apply_event/{id}', [EventController::class, 'applyEvent'])->name('apply_event');
    Route::get('/cancel_event/{id}', [EventController::class, 'cancelEvent'])->name('cancel_event');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->regenerate();
    return redirect()->route('login');
})->name('logout');
