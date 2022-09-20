<?php

use App\Http\Controllers\CicilanController;
use App\Http\Controllers\DetailPinjamanController;
use App\Http\Controllers\PemasukanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SimpananWajibController;
use App\Http\Controllers\SimpananSukarelaController;
use App\Http\Controllers\SimpananPokokController;
use App\Http\Controllers\PemodalController;
use App\Http\Controllers\PinjamanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Route for User
 */
Route::resource('user', UserController::class);

/**
 * Route for Simpanan Wajib
 */
Route::resource('simpanan-wajib', SimpananWajibController::class);

/**
 * Route for Simpanan Sukarela
 */
Route::resource('simpanan-sukarela', SimpananSukarelaController::class);

/**
 * Route for Simpanan Pokok
 */
Route::resource('simpanan-pokok', SimpananPokokController::class);

/**
 * Route for Pemodal
 */
Route::resource('pemodal', PemodalController::class);

/**
 * Route for Pinjaman
 */
Route::resource('pinjaman', PinjamanController::class);

/**
 * Route for Detail Pinjaman
 */
Route::resource('detail-pinjaman', DetailPinjamanController::class);

/**
 * Route for Cicilan
 */
Route::resource('cicilan', CicilanController::class);

/**
 * Route for Pemasukan
 */
Route::resource('pemasukan', PemasukanController::class);
