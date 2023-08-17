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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamansController;
use App\Http\Controllers\PenggunaansController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('template.dashboard');
// })->middleware('auth');

Route::get('/', [DashboardController::class,'index'])->middleware('auth');
Route::get('/activities', [DashboardController::class,'log'])->middleware('auth');

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

//Print
Route::get('/printAlat', [AlatsController::class, 'printAlat'])->middleware('auth');
Route::get('/printBahan', [AlatsController::class, 'printBahan'])->middleware('auth');

// Peminjaman
Route::resource('peminjaman', PeminjamansController::class)->middleware('auth');
Route::get('/detail-peminjamanAlat/{uuid}', [PeminjamansController::class, 'detail'])->middleware('auth');
Route::get('/create-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatCreate'])->middleware('auth');
Route::get('/store-peminjamanAlat', [PeminjamansController::class, 'peminjamanAlatStore'])->middleware('auth');
Route::get('/edit-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatEdit'])->middleware('auth');
Route::get('/update-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatUpdate'])->middleware('auth');
Route::delete('/destroy-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatDestroy'])->middleware('auth');
// Peminjaman Alat
Route::get('/status1-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatStatus1'])->middleware('auth');
Route::get('/status2-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatStatus2'])->middleware('auth');
Route::get('/status3-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatStatus3'])->middleware('auth');
Route::get('/status4-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatStatus4'])->middleware('auth');
// Pengembalian Alat
Route::get('/status5-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatStatus5'])->middleware('auth');
Route::get('/status6-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatStatus6'])->middleware('auth');
Route::get('/status7-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatStatus7'])->middleware('auth');
Route::get('/status8-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatStatus8'])->middleware('auth');
Route::get('/statusTolak-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatStatusTolak'])->middleware('auth');
//  status cek dan pengurangan stok lama
Route::get('/check-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatCheck'])->middleware('auth');
Route::get('/kondisiPeminjaman-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatKondisiPeminjaman'])->middleware('auth');
Route::get('/check-pengembalianAlat/{uuid}', [PeminjamansController::class, 'pengembalianAlatCheck'])->middleware('auth');
Route::get('/kondisiPengembalian-peminjamanAlat/{uuid}', [PeminjamansController::class, 'peminjamanAlatKondisiPengembalian'])->middleware('auth');

// Penggunaan
Route::resource('penggunaan', PenggunaansController::class)->middleware('auth');
Route::get('/detail-penggunaanBahan/{uuid}', [PenggunaansController::class, 'detail'])->middleware('auth');
Route::get('/create-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanCreate'])->middleware('auth');
Route::get('/store-penggunaanBahan', [PenggunaansController::class, 'penggunaanBahanStore'])->middleware('auth');
Route::get('/edit-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanEdit'])->middleware('auth');
Route::get('/update-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanUpdate'])->middleware('auth');
Route::delete('/destroy-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanDestroy'])->middleware('auth');
Route::get('/status1-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanStatus1'])->middleware('auth');
Route::get('/status2-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanStatus2'])->middleware('auth');
//  status 3
Route::get('/check-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanCheck'])->middleware('auth');
Route::get('/note-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanNote'])->middleware('auth');
// /status 3
Route::get('/status3-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanStatus3'])->middleware('auth');
Route::get('/status4-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanStatus4'])->middleware('auth');
Route::get('/statusTolak-penggunaanBahan/{uuid}', [PenggunaansController::class, 'penggunaanBahanStatusTolak'])->middleware('auth');