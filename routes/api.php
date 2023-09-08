<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [SiswaController::class, 'login'])->name('login');
Route::get('absensi/{nisn}', [SiswaController::class, 'absensi'])->name('absensi');
Route::post('clockin', [SiswaController::class, 'clockin'])->name('clockin');
Route::post('clockout', [SiswaController::class, 'clockout'])->name('clockout');
