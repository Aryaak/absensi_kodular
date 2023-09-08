<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('cekGuru')->group(function () {
    Route::get('/', [AbsensiController::class, 'index'])->name('index');
    Route::put('update/{absensi}', [AbsensiController::class, 'update'])->name('update');

    Route::get('logout', [GuruController::class, 'logout'])->name('logout');
});


Route::middleware('cekLogin')->group(function () {
    Route::get('login', [GuruController::class, 'login'])->name('login');
    Route::post('login/check', [GuruController::class, 'loginCheck'])->name('login.check');
});

Route::get('ortu', [AbsensiController::class, 'ortu'])->name('ortu');
Route::get('ortu/hasil', [AbsensiController::class, 'ortuHasil'])->name('ortu.hasil');
