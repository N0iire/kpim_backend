<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\CicilanController;
use App\Http\Controllers\DetailNonPembelianController;
use App\Http\Controllers\DetailPinjamanController;
use App\Http\Controllers\PemasukanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SimpananWajibController;
use App\Http\Controllers\SimpananSukarelaController;
use App\Http\Controllers\SimpananPokokController;
use App\Http\Controllers\PemodalController;
use App\Http\Controllers\PengeluaranController;
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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
});


/**
 * Route for User
 */
Route::apiResource('user', UserController::class);

/**
 * Route for Simpanan Wajib
 */
Route::apiResource('simpanan-wajib', SimpananWajibController::class);

/**
 * Route for Simpanan Sukarela
 */
Route::apiResource('simpanan-sukarela', SimpananSukarelaController::class);

/**
 * Route for Simpanan Pokok
 */
Route::apiResource('simpanan-pokok', SimpananPokokController::class);

/**
 * Route for Pemodal
 */
Route::apiResource('pemodal', PemodalController::class);

/**
 * Route for Pinjaman
 */
Route::apiResource('pinjaman', PinjamanController::class);

/**
 * Route for Detail Pinjaman
 */
Route::apiResource('detail-pinjaman', DetailPinjamanController::class);

/**
 * Route for Cicilan
 */
Route::apiResource('cicilan', CicilanController::class);

/**
 * Route for Pemasukan
 */
Route::apiResource('pemasukan', PemasukanController::class);

/**
 * Route for Pengeluaran
 */
Route::apiResource('pengeluaran', PengeluaranController::class);

/**
 * Route for Detail Non Pembelian
 */
Route::apiResource('detail-non-pembelian', DetailNonPembelianController::class);

// Route for Barang
Route::apiResource('barang', BarangController::class);