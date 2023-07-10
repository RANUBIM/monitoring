<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LaborsController;
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

// Log
Route::resource('log', LogController::class);

Route::resource('user', UsersController::class);
Route::resource('labor', LaborsController::class);
Route::resource('alat', AlatsController::class);
Route::resource('bahan', BahansController::class);