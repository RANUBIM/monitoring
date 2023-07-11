<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LaborsController;
// use App\Http\Controllers\Auth\LoginController;

// Login
use App\Http\Controllers\LoginController;

// Master
use App\Http\Controllers\LaborsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AlatsController;
use App\Http\Controllers\BahansController;

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
    return view('template.dashboard');

//Route Labor
// Route::resource("/Labor", LaborsController::class);
// Route::get("/labors", [LaborsController::class, 'index']);
});

// Login
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);

// Log
Route::resource('log', LogController::class);

// Master
Route::resource('user', UsersController::class);
// ->middleware('auth');
Route::resource('labor', LaborsController::class);
// ->middleware('auth');
Route::resource('alat', AlatsController::class);
// ->middleware('auth');
Route::resource('bahan', BahansController::class);
// ->middleware('auth');