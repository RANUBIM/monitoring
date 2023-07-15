<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LaborsController;
// use App\Http\Controllers\Auth\LoginController;

// Login
use App\Http\Controllers\AlatsController;

// Master
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BahansController;
use App\Http\Controllers\LaborsController;
use App\Http\Controllers\PeminjamansController;

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
})->middleware('auth');;

// Login
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);

// Log
Route::resource('log', LogController::class)->middleware('auth');

// Master
Route::resource('user', UsersController::class)->middleware('auth');
Route::resource('labor', LaborsController::class)->middleware('auth');
Route::resource('alat', AlatsController::class)->middleware('auth');
Route::resource('bahan', BahansController::class)->middleware('auth');

// Main
Route::resource('peminjaman', PeminjamansController::class)->middleware('auth');