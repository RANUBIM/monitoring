<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LaborsController;
use App\Http\Controllers\LaborsController;

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

// Route::get('/labor', [LaborsController::class, 'index']);
// Route::get('/labor-add', [LaborsController::class, 'create']);

Route::resource('user', LaborsController::class);
Route::resource('labor', LaborsController::class);
// Route::get('/labor-add', [LaborsController::class, 'create']);